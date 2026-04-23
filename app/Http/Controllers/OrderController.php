<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

        try {
            // 1. Lưu đơn hàng vào Database thông qua Transaction
            $result = DB::transaction(function () use ($cart, $user) {
                $order = Order::create([
                    'user_id'     => $user->id,
                    'total_price' => 0,
                    'status'      => 'pending'
                ]);

                $total = 0;
                $payosItems = [];

                foreach ($cart as $gameId => $details) {
                    $game = Game::findOrFail($gameId);
                    $qty  = is_array($details) ? ($details['quantity'] ?? 1) : $details;

                    if ($game->availableKeys()->count() < $qty) {
                        throw new \Exception("Game {$game->name} chỉ còn {$game->availableKeys()->count()} key.");
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'game_id'  => $gameId,
                        'quantity' => $qty,
                        'price'    => $game->price,
                    ]);

                    $total += $game->price * $qty;

                    $payosItems[] = [
                        'name'     => $game->name,
                        'quantity' => (int) $qty,
                        'price'    => (int) $game->price,
                    ];
                }

                $order->update(['total_price' => $total]);
                return [$order, $payosItems];
            });

            [$order, $payosItems] = $result;

            // 2. Khởi tạo PayOS SDK để tự động tạo Signature
            $payOS = new PayOS(
                config('payos.client_id'),
                config('payos.api_key'),
                config('payos.checksum_key')
            );

            // 3. Chuẩn bị dữ liệu theo yêu cầu của SDK
            $data = [
                'orderCode'   => intval($order->id),
                'amount'      => intval($order->total_price),
                'description' => 'Thanh toan don hang #' . $order->id,
                'items'       => $payosItems,
                'returnUrl'   => config('payos.return_url'),
                'cancelUrl'   => config('payos.cancel_url'),
                'buyerName'   => $user->name ?? 'Khach hang',
                'buyerEmail'  => $user->email ?? '',
                'buyerPhone'  => '0363636363',
            ];

            // 4. Tạo link thanh toán qua SDK
            $response = $payOS->createPaymentLink($data);

            if (isset($response['checkoutUrl'])) {
                session()->forget('cart');
                return response()->json([
                    'success' => true,
                    'checkoutUrl' => $response['checkoutUrl']
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'Không thể tạo link thanh toán từ PayOS'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
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
        $payload = $request->all();
        Log::info('PayOS Webhook received:', $payload);

        try {
            $payOS = new PayOS(
                config('payos.client_id'),
                config('payos.api_key'),
                config('payos.checksum_key')
            );

            // Xác thực chữ ký bằng SDK
            $webhookData = $payOS->verifyPaymentWebhookData($payload);

            // Xử lý khi thanh toán thành công (mã 00)
            if ($payload['code'] === '00') {
                $orderCode = $webhookData['orderCode'];

                DB::transaction(function () use ($orderCode) {
                    $order = Order::with('items.game')->find($orderCode);

                    if ($order && $order->status !== 'completed') {
                        foreach ($order->items as $item) {
                            $game = $item->game;
                            $keys = $game->availableKeys()->limit($item->quantity)->get();

                            foreach ($keys as $key) {
                                $key->update(['is_sold' => true]);
                                $order->gameKeys()->attach($key->id);
                            }
                        }

                        $order->update(['status' => 'completed']);
                        Log::info("Đơn hàng #{$orderCode} đã hoàn tất.");
                    }
                });
            }

            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            Log::error('PayOS Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature or data'], 401);
        }
    }

    public function checkoutView()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $id => $details) {
            $game = \App\Models\Game::find($id);
            if ($game) {
                $qty = is_array($details) ? ($details['quantity'] ?? 1) : $details;
                $total += $game->price * $qty;
            }
        }

        return view('checkout', compact('total'));
    }
}