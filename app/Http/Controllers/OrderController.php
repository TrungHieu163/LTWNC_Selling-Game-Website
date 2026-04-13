<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session('cart');

        if (!$cart || empty($cart)) {
            return response()->json(['error' => 'Giỏ hàng trống'], 400);
        }

        $user = auth()->user();

        return DB::transaction(function () use ($cart, $user) {

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => 0,
                'status' => 'pending'
            ]);

            $total = 0;
            $allKeys = [];

            foreach ($cart as $gameId => $qty) {
                $game = Game::findOrFail($gameId);

                // Kiểm tra có đủ key chưa bán không
                $availableCount = $game->availableKeys()->count();

                if ($availableCount < $qty) {
                    throw new \Exception("Game '{$game->name}' chỉ còn {$availableCount} key. Bạn yêu cầu {$qty}.");
                }

                // Tạo OrderItem
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'game_id' => $gameId,
                    'quantity' => $qty,
                    'price' => $game->price,
                ]);

                // Lấy và mark key là đã bán
                $keys = $game->availableKeys()
                             ->limit($qty)
                             ->get();

                foreach ($keys as $key) {
                    $key->update(['is_sold' => true]);

                    $allKeys[] = [                 
                        'game_name' => $game->name,
                        'key_code'  => $key->key_code,
                    ];
                }

                $total += $game->price * $qty;
            }

            $order->update([
                'total_price' => $total,
                'status' => 'completed'
            ]);

            // Xóa giỏ hàng
            session()->forget('cart');

            // Load relation để trả về đầy đủ
            $order->load(['items.game']);

            return response()->json([
                'success' => true,
                'message' => 'Đặt hàng thành công! Dưới đây là mã kích hoạt game của bạn.',
                'order_id' => $order->id,
                'total'    => $total,
                'status'   => 'completed',
                'items' => $order->items->map(function ($item) {
                    return [
                        'game_name' => $item->game->name,
                        'quantity'  => $item->quantity,
                        'price'     => $item->price,
                        'subtotal'  => $item->price * $item->quantity,
                    ];
                }),
                'keys' => $allKeys,
            ]);
        });
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->with(['items.game'])           // load game trong items
                       ->latest()
                       ->paginate(10);

        $orders->getCollection()->transform(function ($order) {
            return [
                'id' => $order->id,
                'total_price' => $order->total_price,
                'status' => $order->status,
                'created_at' => $order->created_at->format('d/m/Y H:i'),
                'items' => $order->items->map(function ($item) {
                    return [
                        'game_name' => $item->game->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'subtotal' => $item->price * $item->quantity,
                    ];
                }),
            ];
        });

        return response()->json($orders);
    }

    //Xem chi tiết một đơn hàng
    public function showOrder($id)
    {
        $order = Order::where('user_id', auth()->id())
                      ->with(['items.game'])
                      ->findOrFail($id);

        return response()->json($order);
    }
}