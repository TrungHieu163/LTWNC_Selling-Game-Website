<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id) {
        $cart = session()->get('cart', []);

        $cart[$id] = ($cart[$id] ?? 0) + 1;

        session()->put('cart', $cart);

        return response()->json($cart);
    }

    public function index() {
        return session('cart', []);
    }
}
