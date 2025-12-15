<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
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

        // Filter selected games if provided
        $selectedGameIds = $request->get('selected') ? explode(',', $request->get('selected')) : [];
        if (!empty($selectedGameIds)) {
            $cart->items = $cart->items->filter(function($item) use ($selectedGameIds) {
                return in_array($item->game_id, $selectedGameIds);
            });
        }

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Please select at least one game to checkout');
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
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'completed',
        ]);

        // Create order items and add games to user library
        foreach ($cart->items as $item) {
            $order->items()->create([
                'game_id' => $item->game_id,
                'quantity' => $item->quantity,
                'price' => $item->game->price,
            ]);

            // Add game to user's library
            UserGame::create([
                'user_id' => auth()->id(),
                'game_id' => $item->game_id,
                'order_id' => $order->id,
                'purchased_at' => now(),
            ]);
        }

        // Clear cart
        $cart->items()->delete();
        // The cart itself is not deleted, only its items.
        // $cart->delete(); // Removed this line as per instruction

        return redirect()->route('library.index')->with('success', 'Order placed successfully! Your games are now in your library.');
    }
}
