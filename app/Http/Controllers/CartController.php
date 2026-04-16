<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class CartController extends Controller
{
    public function add($id) {
        // Tìm game trong DB
        $game = Game::findOrFail($id);
        $cart = session()->get('cart', []);

        $availableCount = $game->availableKeys()->count();
        if ($availableCount <= 0) {
            return back()->with('error', 'Xin lỗi, Game ' . $game->name . ' hiện đã hết mã kích hoạt!');
        }

       // Nếu đã có trong giỏ, kiểm tra xem cộng thêm 1 có vượt quá số key đang có không
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] + 1 > $availableCount) {
                return back()->with('error', 'Bạn không thể mua thêm vì chỉ còn ' . $availableCount . ' key!');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $game->name,
                "quantity" => 1,
                "price" => $game->price,
                "image" => $game->image
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Đã thêm game vào giỏ hàng!');
    }

    public function index() {
        return view('giohang');
    }

    public function remove($id) {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Đã xóa game khỏi giỏ hàng!');
    }
}
