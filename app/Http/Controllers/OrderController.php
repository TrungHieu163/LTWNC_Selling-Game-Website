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
                    // Nếu muốn lưu key cụ thể vào order → tạo bảng pivot sau này
                }

                $total += $game->price * $qty;
            }

            $order->update(['total_price' => $total]);

            // Xóa giỏ hàng
            session()->forget('cart');

            // Load relation để trả về đầy đủ
            $order->load(['items.game']);

            return response()->json([
                'message' => 'Đặt hàng thành công!',
                'order' => $order,
                'total' => $total
            ]);
        });
    }
}