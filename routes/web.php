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


// Home page
Route::get('/', 'Top40Controller@index');

// Page d'un artiste dont l'id est récupéré grâce aux a href
Route::get('/artist/{id}', 'ArtistController@index');

// Page des favoris (avec les fonctions et autres pages liées)
Route::get('/favorites', 'FavoritesController@index')->name('favorites');
Route::post('/favorites-insert', 'FavoritesController@insert')->name('favorites-insert');
Route::get('/favorites-delete', 'FavoritesController@delete')->name('favorites-delete');
Route::get('/favorites-edit', 'FavoritesController@edit')->name('favorites-edit');
Route::get('/favorites-update', 'FavoritesController@update')->name('favorites-update');