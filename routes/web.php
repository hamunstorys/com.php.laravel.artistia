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

Route::get('/', function () {
    return view('index');
});


Route::prefix('star')->group(function () {

    Route::get('/', [
        'as' => 'star.index',
        'uses' => 'Star\IndexController@index'
    ]);

    Route::get('/users/login', [
        'as' => 'star.session.create',
        'uses' => 'Star\SessionController@create'
    ]);

    Route::post('/users/login', [
        'as' => 'star.session.store',
        'uses' => 'Star\SessionController@store'
    ]);

    Route::get('/users/logout', [
        'as' => 'star.session.destroy',
        'uses' => 'Star\SessionController@destroy'
    ]);

    Route::get('/artist/{artist}/edit', [
        'as' => 'star.artist.edit',
        'uses' => 'Star\ArtistController@edit'
    ]);

    Route::put('/artist/{artist}', [
        'as' => 'star.artist.update',
        'uses' => 'Star\ArtistController@update'
    ]);

    Route::get('/artist/register', [
        'as' => 'star.artist.create',
        'uses' => 'Star\ArtistController@create'
    ]);

    Route::post('/artist/register', [
        'as' => 'star.artist.store',
        'uses' => 'Star\ArtistController@store'
    ]);

    Route::post('/artist/register/confirm', [
        'as' => 'star.artist.confirmStore',
        'uses' => 'Star\ArtistController@confirmStore'
    ]);


    Route::delete('/artist/{artist}', [
        'as' => 'star.artist.destroy',
        'uses' => 'Star\ArtistController@destroy'
    ]);

    Route::get('/search', [
        'as' => 'star.search',
        'uses' => 'Star\SearchController@search'
    ]);

    Route::get('/search/results', [
        'as' => 'star.search.results',
        'uses' => 'Star\SearchController@showResults'
    ]);
});