<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PayOS\PayOS;

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

            foreach ($cart as $gameId => $details) {
                $game = Game::findOrFail($gameId);

                // Lấy số lượng từ mảng details (nếu không có thì mặc định là 1)
                $qty = is_array($details) ? ($details['quantity'] ?? 1) : $details;

                // Kiểm tra có đủ key chưa bán không
                $availableCount = $game->availableKeys()->count();

                if ($availableCount < $qty) {
                    // Sửa lỗi Array to string conversion ở đây bằng cách dùng biến $qty đã xử lý
                    throw new \Exception("Game " . $game->name . " chỉ còn " . $availableCount . " key.");
                }

                // Tạo OrderItem
                OrderItem::create([
                    'order_id' => $order->id,
                    'game_id' => $gameId,
                    'quantity' => $qty,
                    'price' => $game->price,
                ]);

                $total += $game->price * $qty;
            }

            $order->update([
                'total_price' => $total,
            ]);

            // BƯỚC 2: Chuẩn bị dữ liệu gửi sang PayOS
            $orderCode = intval($order->id);
            $description = "Thanh toan don hang #$orderCode";
            $returnUrl = route('library'); // Link quay về khi thành công
            $cancelUrl = route('giohang'); // Link quay về khi hủy

            // BƯỚC 3: Tạo chữ ký Signature (Bắt buộc theo chuẩn PayOS)
            $checksumKey = env('PAYOS_CHECKSUM_KEY');
            $dataToSign = "amount=$total&cancelUrl=$cancelUrl&description=$description&orderCode=$orderCode&returnUrl=$returnUrl";
            $signature = hash_hmac('sha256', $dataToSign, $checksumKey);

            // BƯỚC 4: Gọi API tạo Link thanh toán
            $response = Http::withHeaders([
                'x-client-id' => env('PAYOS_CLIENT_ID'),
                'x-api-key' => env('PAYOS_API_KEY'),
            ])->post('https://api-merchant.payos.vn/v2/payment-requests', [
                "orderCode" => $orderCode,
                "amount" => $total,
                "description" => $description,
                "cancelUrl" => $cancelUrl,
                "returnUrl" => $returnUrl,
                "signature" => $signature
            ]);

            $resData = $response->json();

            if (isset($resData['code']) && $resData['code'] == "00") {
                // Xóa giỏ hàng vì đơn hàng đã được khởi tạo thành công trên hệ thống bank
                session()->forget('cart');

                return response()->json([
                    'success' => true,
                    'checkoutUrl' => $resData['data']['checkoutUrl'] // Trả link này về để JS chuyển hướng
                ]);
            }

            throw new \Exception("Lỗi PayOS: " . ($resData['desc'] ?? 'Không thể tạo link thanh toán'));
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

    /**
     * Hiển thị Thư viện game đã mua (mỗi game chỉ hiển thị một lần)
     */
    public function myLibraryView()
    {
        $libraryItems = OrderItem::whereHas('order', function ($query) {
                $query->where('user_id', auth()->id())
                    ->where('status', 'completed');
            })
            ->with(['game.categories', 'order'])   // load thêm categories nếu cần
            ->latest('created_at')                 // sắp xếp theo thời gian mua
            ->get()
            ->unique('game_id')                    // loại bỏ game trùng
            ->values();                            // reset key array

        // Xử lý description null
        $libraryItems->each(function ($item) {
            if ($item->game && is_null($item->game->description)) {
                $item->game->description = '';
            }
        });

        return view('library', compact('libraryItems'));
    }

    public function showOrderView($id, $game_id = null)
    {
        // Nếu có game_id, mình sẽ lấy TẤT CẢ các key của game đó mà User này sở hữu
        if ($game_id) {
            $gameKeys = \App\Models\GameKey::where('game_id', $game_id)
                ->whereHas('order', function($q) {
                    $q->where('user_id', auth()->id());
                })
                ->with('game')
                ->latest()
                ->get();

            // Tạo một object giả lập để không phải sửa giao diện Blade nhiều
            $order = (object)[
                'id' => 'Tất cả đơn hàng',
                'created_at' => now(),
                'gameKeys' => $gameKeys
            ];
        } else {
            // Nếu không có game_id, vẫn hiện theo từng đơn hàng như cũ
            $order = Order::where('user_id', auth()->id())
                        ->with('gameKeys.game')
                        ->findOrFail($id);
        }

        return view('keys', compact('order'));
    }
    
    public function handlePayOSWebhook(Request $request)
    {
        $body = $request->all();

        // 1. Lấy checksum key từ .env
        $checksumKey = env('PAYOS_CHECKSUM_KEY');

        // 2. Kiểm tra signature
        if (!PayOS::verifySignature($body, $checksumKey)) {
            \Log::warning('PayOS Webhook: Signature không hợp lệ', $body);
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // 3. Xử lý khi thanh toán thành công
        if (isset($body['data']) && $body['success'] === true) {
            $orderCode = $body['data']['orderCode'];

            DB::transaction(function () use ($orderCode) {
                $order = Order::with('items.game')->find($orderCode);

                if ($order && $order->status !== 'completed') {
                    foreach ($order->items as $item) {
                        $game = $item->game;

                        $keys = $game->availableKeys()
                                    ->limit($item->quantity)
                                    ->get();

                        foreach ($keys as $key) {
                            $key->update(['is_sold' => true]);
                            $order->gameKeys()->attach($key->id);
                        }
                    }

                    $order->update(['status' => 'completed']);
                    
                    \Log::info("Đơn hàng #$orderCode đã được hoàn tất và cấp key thành công.");
                }
            });
        }

        // Luôn trả về 200 OK cho PayOS
        return response()->json(['success' => true], 200);
    }
}