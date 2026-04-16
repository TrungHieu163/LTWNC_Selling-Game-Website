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

            foreach ($cart as $gameId => $details) {
                $game = Game::findOrFail($gameId);

                // Lấy số lượng từ mảng details (nếu không có thì mặc định là 1)
                $qty = is_array($details) ? ($details['quantity'] ?? 1) : $details;

                // Kiểm tra có đủ key chưa bán không
                $availableCount = $game->availableKeys()->count();

                if ($availableCount < $qty) {
                    // Sửa lỗi Array to string conversion ở đây bằng cách dùng biến $qty đã xử lý
                    throw new \Exception("Game " . $game->name . " chỉ còn " . $availableCount . " key. Bạn yêu cầu " . $qty . ".");
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
                    
                    $order->gameKeys()->attach($key->id);

                    $allKeys[] = [                 
                        'game_name' => $game->name,
                        'key_code'  => $key->key_code,
                        'key_id'    => $key->id
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
                       ->with(['items.game', 'gameKeys.game'])
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
                'keys' => $order->gameKeys->map(function ($key) {
                return [
                    'game_name' => $key->game ? $key->game->name : 'Unknown Game',
                    'key_code'  => $key->key_code,
                ];
            })
            ];
        });

        return response()->json($orders);
    }

    //Xem chi tiết một đơn hàng
    public function showOrder($id)
    {
        $order = Order::where('user_id', auth()->id())
                    ->with(['items.game', 'gameKeys.game'])
                    ->findOrFail($id);

        return response()->json([
            'id'          => $order->id,
            'total_price' => $order->total_price,
            'status'      => $order->status,
            'created_at'  => $order->created_at->format('d/m/Y H:i'),
            
            'items' => $order->items->map(function ($item) {
                return [
                    'game_name' => $item->game->name,
                    'quantity'  => $item->quantity,
                    'price'     => $item->price,
                    'subtotal'  => $item->price * $item->quantity,
                ];
            }),

            'keys' => $order->gameKeys->map(function ($key) {
                return [
                    'game_name' => optional($key->game)->name ?? 'Unknown Game',
                    'key_code'  => $key->key_code,
                ];
            }),
        ]);
    }

    public function myOrdersView()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->with(['items.game', 'gameKeys.game'])
                       ->latest()
                       ->paginate(12);

        // Đảm bảo không lỗi nếu description null
        $orders->getCollection()->each(function ($order) {
            $order->items->each(function ($item) {
                if (is_null($item->game->description)) {
                    $item->game->description = [];
                }
            });
        });

        return view('libary', compact('orders'));
    }

    public function showOrderView($id)
    {
        $order = Order::where('user_id', auth()->id())
                      ->with(['items.game', 'gameKeys.game'])
                      ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}