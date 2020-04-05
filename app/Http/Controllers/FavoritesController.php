<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoritesController extends Controller
{
    // Retourne la vue avec tous les favoris
    public function index() {
        $favorites = \App\Favorite::all();

        return view('favorites', ['favorites' => $favorites]);
    }

    // Ajoute une ligne à la BDD
    public function insert(Request $request) {
        // Créé une nouvelle ligne
        $favorite = new Favorite;
        // [2] Récupère valeurs des 2 input text
        $favorite->artists = $request->input('artists');
        $favorite->track_name = $request->input('track_name');
        // Remplie la ligne
        $favorite->save();

        return view('favorites-added');
    }

    // Supprime une ligne sur la BDD
    public function delete(Request $request) {
        // [2] Sélectionne la ligne de de l'id de l'input hidden
        $favorite_id = $request->input('track_id');
        $favorite = \App\Favorite::find($favorite_id);
        // Supprime la ligne
        $favorite->delete();

        return view('favorites-deleted');
    }

    // Affiche la vue permettant de modifier une ligne
    public function edit() {
        // Récupère l'id de la track qui se trouve dans l'URL
        $track_id = $_GET["track_id"];
        // Sélectionne la ligne
        $favorite = \App\Favorite::find($track_id);
        // [2] Créé des variables pour les input text: les valeurs actuelles pourront déjà être pré-écrites. (le track_id est aussi envoyé pour la fonction update)
        $artist= $favorite->artists;
        $track_name= $favorite->track_name;

        return view('favorites-edit', compact("track_id", "artist", "track_name"));
        
    }

    // Met à jour une ligne de la BDD
    public function update(Request $request) {
        // [2] Sélectionne la ligne de de l'id de l'input hidden
        $favorite_id = $request->input('track_id');
        $favorite = \App\Favorite::find($favorite_id);
        // Assigne les nouvelles valeurs
        $favorite->artists = $request->input('artists');
        $favorite->track_name = $request->input('track_name');
        // Écrase les valeurs sur la BDD
        $favorite->save();

        return view('favorites-edited');
    }
}
