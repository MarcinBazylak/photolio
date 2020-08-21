<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

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

Route::domain('{username}.' . Config::get('app.url'))->group(function () {
   Route::get('/', 'GalleryController@index');
   Route::get('/kontakt', 'GalleryController@contact');
   Route::get('/o-mnie', 'GalleryController@aboutMe');
   Route::post('/kontakt', 'EmailController@sendToUser');
   Route::get('/album-{album}', 'GalleryController@album');
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//PANEL

Route::get('/panel', 'SettingsController@index');

Route::put('/panel/settings', 'SettingsController@updateUserSettings');

Route::put('/panel/aboutme', 'SettingsController@updateAboutMe');

Route::post('/panel/header', 'SettingsController@updateHeaderPhoto');

// PHOTOS

Route::get('/panel/photos', 'PhotoController@index');

Route::post('/panel/photos', 'PhotoController@store');

Route::get('/panel/photo/{photo}/delete', 'PhotoController@delete');

Route::post('/panel/photo/{photo}/delete', 'PhotoController@destroy');

Route::get('/panel/photo/{photo}/edit', 'PhotoController@edit');

Route::put('/panel/photo/{photo}/edit', 'PhotoController@update');

// albums

Route::get('/panel/albums', 'AlbumController@index');

Route::post('/panel/albums', 'AlbumController@store');

Route::get('/panel/album/{album}/delete', 'AlbumController@delete');

Route::post('/panel/album/{album}/delete', 'AlbumController@destroy');

Route::get('/panel/album/{album}/edit', 'AlbumController@edit');

Route::put('/panel/album/{album}/edit', 'AlbumController@update');

// GALLERY

Route::get('/{username}', 'GalleryController@index');

Route::get('/{username}/o-mnie', 'GalleryController@aboutMe');

Route::get('/{username}/kontakt', 'GalleryController@contact');

Route::post('/{username}/kontakt', 'EmailController@sendToUser');

Route::get('/{username}/album-{album}', 'GalleryController@album');