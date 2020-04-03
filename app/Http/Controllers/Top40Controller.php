<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Top40Controller extends Controller
{
    public function index() {

        // Requête 1 récupérée sur Insomnia
		$curl = curl_init();
		
		// Ces deux lignes évitent l'erreur hyper reloue 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt_array($curl, array(
		  // Requete avec l'ID du top 40 HS
		  CURLOPT_URL => "https://api.deezer.com/playlist/3500811162",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_FOLLOWLOCATION => true,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else {
			

			// Pour convertir le tableau JSON en object PHP
			$playlist = json_decode($response);
			//dd($playlist);


			// Le titre de la playlist (le h2)
			$playlist_title = $playlist->title;
			// Les 40 tracks
			$playlist_tracks = $playlist->tracks->data;

			// Tableaux qui vont récupérer les différentes valeurs dont j'ai besoin
			$a = array();
			$track_title = array();
			$release_date = array();
			$artwork = array();
			$artists_table = array();
			$artists_id_table = array();

			// Pour chaque track
			foreach ($playlist_tracks as $key => $playlist_track) {

				// Requête 2 nécéssaire pour avoir toutes les infos que je souhaite sur chacune des musiques
				$curl2 = curl_init();

				// Ces deux lignes évitent l'erreur hyper reloue 
				curl_setopt($curl2, CURLOPT_FOLLOWLOCATION, TRUE);
	        	curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);

				curl_setopt_array($curl2, array(
				  // Requête avec l'ID de chacune des tracks
				  CURLOPT_URL => "https://api.deezer.com/track/".$playlist_track->id,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_POSTFIELDS => "",
				  CURLOPT_COOKIE => "dzr_uniq_id=dzr_uniq_id_fr986a607b714caf524f70d55e9d920a5b2de2ae; sid=frb68f5817c60236b5e6eace34fee0e37aeaa137",
				));

				$response2 = curl_exec($curl2);
				$err2 = curl_error($curl2);

				curl_close($curl2);

				if ($err2) {
				  echo "cURL Error #:" . $err2;
				} 
				else {		
					$track_data = json_decode($response2);
					
					// On remplie les tableaux
					//// Pour voir toutes les infos dispo
					////array_push($a, $track_data);
					//// Titre
					array_push($track_title, $track_data->title);
					//// Date de sortie
					array_push($release_date, $track_data->release_date);
					//// Artwork
					array_push($artwork, $track_data->album->cover);

					// Pour avoir les noms des artistes
					$artists = array();
					// Pour avoir les ID des artistes (pour ensuite renvoyer vers la page de l'artiste lors d'un clic)
					$artists_id = array();

					// Autre boucle car peut avoir plusieurs artistes
					foreach ($track_data->contributors as $key2 => $contributors)
					{
						array_push($artists, $contributors->name);
						array_push($artists_id, $contributors->id);
					}
					array_push($artists_table, $artists);
					array_push($artists_id_table, $artists_id);
				}
			}
			//dd($artists_id_table);
		}
		return view('welcome', compact("playlist_title", "playlist_tracks", "track_data", "track_title", "release_date", "artwork", "artists_table", "artists_id_table"));
    }
}
