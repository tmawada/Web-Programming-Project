<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
         $cart = null;
         if (Auth::check()) {
            $cart = Cart::with('items.game')->where('user_id', Auth::id())->first();
        } else {
            $cart = Cart::with('items.game')->where('session_id', Session::getId())->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        // Simple mock checkout
        $cart = null;
         if (Auth::check()) {
            $cart = Cart::with('items.game')->where('user_id', Auth::id())->first();
        } else {
            $cart = Cart::with('items.game')->where('session_id', Session::getId())->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
             return redirect()->route('cart.index');
        }

        if (!Auth::check()) {
            // Force login for checkout or allow guest? Let's force login for now as per "user can login and register" requirement usually implies account needed for order
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $total = $cart->items->sum(function($item) {
            return $item->game->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'completed',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'game_id' => $item->game_id,
                'quantity' => $item->quantity,
                'price' => $item->game->price,
            ]);
        }

        // Clear cart
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('games.index')->with('success', 'Order placed successfully!');
    }
}
