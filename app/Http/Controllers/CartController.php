<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            return Cart::with('items.game')->where('user_id', Auth::id())->first();
        } else {
            return Cart::with('items.game')->where('session_id', Session::getId())->first();
        }
    }

    private function getOrCreateCart()
    {
        $cart = $this->getCart();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'session_id' => Session::getId(),
            ]);
        }
        
        // If user logged in now but cart was session based, we might want to merge, but let's keep it simple.
        // Also ensure user_id is set if they just logged in.
        if (Auth::check() && !$cart->user_id) {
             $cart->update(['user_id' => Auth::id()]);
        }

        return $cart;
    }

    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Game $game)
    {
        $cart = $this->getOrCreateCart();

        $cartItem = $cart->items()->where('game_id', $game->id)->first();

        if ($cartItem) {
            return redirect()->back()->with('info', 'This game is already in your cart.');
        } else {
            $cart->items()->create([
                'game_id' => $game->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Game added to cart!');
    }

    public function remove(CartItem $item)
    {
        // Security check: ensure item belongs to current user's cart
        $cart = $this->getCart();
        if ($item->cart_id === $cart->id) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}
