<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with('category');

        // Tìm kiếm theo tên game
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Phân trang (12 game/trang)
        $games = $query->latest()->paginate(12);

        return response()->json($games);
    }

    public function show($id) {
        return Game::with('category')->findOrFail($id);
    }
}
