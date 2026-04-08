<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Game;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart');

        if (!$cart) {
            return response()->json(['error' => 'Cart empty']);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'pending'
        ]);

        $total = 0;

        foreach ($cart as $gameId => $qty) {
            $game = Game::find($gameId);

            $price = $game->price * $qty;

            OrderItem::create([
                'order_id' => $order->id,
                'game_id' => $gameId,
                'quantity' => $qty,
                'price' => $game->price
            ]);

            $total += $price;
        }

        $order->update(['total_price' => $total]);

        session()->forget('cart');

        return response()->json($order);
    }
}