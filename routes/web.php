<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/panel', 'SettingsController@index');

Route::get('/panel/photos', 'PhotoController@index');

Route::get('/panel/albums', 'AlbumController@index');

Route::post('/panel/albums', 'AlbumController@store');

// GALLERY

Route::get('/{username}', 'GalleryController@index');

Route::get('/{username}/o-mnie', 'GalleryController@aboutMe');

Route::get('/{username}/kontakt', 'GalleryController@contact');

Route::post('/{username}/kontakt', 'EmailController@sendToUser');

Route::get('/{username}/album-{album}', 'GalleryController@album');