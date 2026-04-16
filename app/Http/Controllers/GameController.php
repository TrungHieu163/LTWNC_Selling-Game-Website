<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with('categories');

        // Tìm kiếm theo tên game
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->where('categories.id', $request->category_id);
        });
    }

        // Phân trang (12 game/trang)
        $games = $query->latest()->paginate(12);
        $games->getCollection()->transform(function ($game) {
            return [
                'id'          => $game->id,
                'name'        => $game->name,
                'slug'        => $game->slug,
                'price'       => (float) $game->price,
                'description' => $game->description,
                'image'       => $game->image,
                'trailer_url' => $game->trailer_url,
                'categories'  => $game->categories->pluck('name'),   // Chỉ lấy tên category
            ];
        });
        return response()->json($games);
    }

    public function show($id) {
        $game = Game::with('categories')->findOrFail($id);
        
        return response()->json([
            'id'          => $game->id,
            'name'        => $game->name,
            'slug'        => $game->slug,
            'price'       => (float) $game->price,
            'description' => $game->description,
            'image'       => $game->image,
            'trailer_url' => $game->trailer_url,
            'categories'  => $game->categories->pluck('name'),
        ]);
    }
    // === TRẢ VỀ VIEW CHO BLADE ===
    public function indexView()
    {
        $games = Game::with('categories')->latest()->paginate(12);
        return view('trangchu', compact('games'));
    }

    public function showView($id)
    {
        $game = Game::with('categories')->findOrFail($id);
        // Nếu description bị null (do chưa nhập), gán nó thành mảng rỗng 
        // để các chỗ gọi như $game->description['developer'] không bị báo lỗi.
        if (is_null($game->description)) {
            $game->description = [];
        }
        return view('games', compact('game'));
    }
}
