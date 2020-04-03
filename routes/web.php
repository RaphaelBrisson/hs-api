<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'Top40Controller@index');

//id récupéré grâce aux a href
Route::get('/artist/{id}', 'ArtistController@index');


// Route::get('/artist.blade.php', function () {
//     return view('artist');
// });


Route::get('/refuzion', 'ArtistController@index');


// Route::get('/artist/{$artist}', function ($country) {
// 	echo("L'artiste est " . $country);
// })->where('artist', '[A-Za-z]+');


Route::get('/favorites', 'FavoritesController@index')->name('favorites');
Route::post('/favorites-insert', 'FavoritesController@insert')->name('favorites-insert');