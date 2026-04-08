<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index() {
        return Game::with('category')->get();
    }

    public function show($id) {
        return Game::with('category')->findOrFail($id);
    }
}
