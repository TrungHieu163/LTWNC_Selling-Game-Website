<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    private function getNewsData()
    {
        $path = resource_path('views/news/news.json');
        $json = file_get_contents($path);
        return json_decode($json, true);
    }

    public function index()
    {
        $news = $this->getNewsData();
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $allNews = $this->getNewsData();

        // Tìm bài viết có id khớp với id trên URL
        $article = collect($allNews)->firstWhere('id', $id);

        if (!$article) {
            abort(404);
        }

        return view('news.show', compact('article'));
    }
}