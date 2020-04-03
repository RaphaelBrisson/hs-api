<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoritesController extends Controller
{
    public function index() {
        $favorites = \App\Favorite::all();
        return view('favorites', ['favorites' => $favorites]);
    }

    public function insert(Request $request) {
        $favorite = new Favorite;
        $favorite->artists = $request->input('artists');
        $favorite->track_name = $request->input('track_name');

        $favorite->save();

        return view('favorites-added');
    }

}
