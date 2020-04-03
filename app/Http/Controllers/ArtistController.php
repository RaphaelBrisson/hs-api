<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistController extends Controller
{
	// Paramètre $id : id de l'artiste récupéré par la route
    public function index($id) {

		$curl = curl_init();
		
		// Ces deux lignes évitent l'erreur hyper reloue 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt_array($curl, array(
		  // Requete avec l'ID de l'artiste choisi
		  CURLOPT_URL => "https://api.deezer.com/artist/$id",
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
			$artist = json_decode($response);
			//dd($artist);

			$artist_name = $artist->name;
			$artist_picture = $artist->picture_medium;
			// // substr pour limiter le nombre de tracks à 5 (50 dans la requête de base)
			// $artist_tracklist = substr($artist->tracklist, 0, -1);
			$artist_tracklist = $artist->tracklist;
			//dd($artist_tracklist);

			$curl = curl_init();

			// Ces deux lignes évitent l'erreur hyper reloue 
		    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $artist_tracklist,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_POSTFIELDS => "",
			  CURLOPT_COOKIE => "dzr_uniq_id=dzr_uniq_id_fr986a607b714caf524f70d55e9d920a5b2de2ae; sid=frb68f5817c60236b5e6eace34fee0e37aeaa137",
			));

			$response2 = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} 
			else {
				$tracklist = json_decode($response2);
				$tracklist_tracks = $tracklist->data;
				//dd($tracklist_tracks);

				$track_title = array();
				$artwork = array();
				$artists_table = array();
				$artists_id_table = array();

				// Pour chaque track
				foreach ($tracklist_tracks as $key => $tracklist_track) {
					// On remplie les tableaux
					//// Titre
					array_push($track_title, $tracklist_track->title);
					//// Artwork
					array_push($artwork, $tracklist_track->album->cover);

					// Pour avoir les noms des artistes
					$artists = array();
					$artists_id = array();

					// Autre boucle car peut avoir plusieurs artistes
					foreach ($tracklist_track->contributors as $key2 => $contributors)
					{
						array_push($artists, $contributors->name);
						array_push($artists_id, $contributors->id);
					}
					array_push($artists_table, $artists);
					array_push($artists_id_table, $artists_id);
				}
			}
		}

		/*return view('artist', ['response' => json_decode($response)]);*/
		return view('artist', compact("artist_name", "tracklist_tracks", "artist_picture", "track_title", "artwork", "artists_table", "artists_id_table"));
    }
}