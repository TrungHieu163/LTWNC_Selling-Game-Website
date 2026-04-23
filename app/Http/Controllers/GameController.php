<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;

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
        return view('inventory', compact('games'));
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

    public function searchView(Request $request)
    {
        // 1. Lấy tất cả danh mục để hiện ở bộ lọc
        $categories = Category::all();

        // 2. Bắt đầu query tìm kiếm
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

        // 3. Lấy kết quả game (Phân trang 12 game mỗi trang)
        $games = $query->latest()->paginate(12);

        // 4. Trả về view search
        return view('search', compact('categories', 'games'));
    }

    public function suggestions(Request $request)
    {
        $search = $request->query('q');
        $games = [];

        if (strlen($search) >= 2) {
            $games = \App\Models\Game::where('name', 'like', "%$search%")
                ->limit(5)
                ->get(['id', 'name', 'price', 'image']);
        }

        return response()->json($games);
    }
    public function homeView()
    {
        // 1. Lấy dữ liệu Game từ Database
        $bannerGames = Game::latest()->take(5)->get();
        $newGames = Game::latest()->take(9)->get();
        $freeGames = Game::where('price', 0)->latest()->take(3)->get();
        $recentlyReleased = Game::latest()->take(30)->get();
        $topRated = Game::inRandomOrder()->take(30)->get();

        // 2. Lấy dữ liệu Tin tức từ file JSON
        $path = resource_path('views/news/news.json');
        $homeNews = collect([]);

        if (file_exists($path)) {
            $newsJson = file_get_contents($path);
            $allNews = json_decode($newsJson, true);

            // Chỉ lấy tin tức nếu JSON decode thành công
            if (is_array($allNews)) {
                $homeNews = collect($allNews)->take(3);
            }
        }

        // 3. Xác định view (dashboard hoặc welcome)
        $view = request()->is('dashboard') ? 'dashboard' : 'welcome';

        // 4. Return DUY NHẤT một lần với đầy đủ tất cả các biến
        return view($view, compact(
            'bannerGames',
            'newGames',
            'freeGames',
            'recentlyReleased',
            'topRated',
            'homeNews'
        ));
    }
}