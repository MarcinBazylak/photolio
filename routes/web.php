<?php

use App\Mail\VerificationCompleted;
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

Route::get('/verificationSuccessful', function () {
   return view('auth.verificationCompleted');
});

Route::domain('{username}.' . Config::get('app.url'))->group(function () {
   Route::get('/', 'GalleryController@index');
   Route::get('/kontakt', 'GalleryController@contact');
   Route::get('/o-mnie', 'GalleryController@aboutMe');
   Route::post('/kontakt', 'EmailController@sendToUser');
   Route::get('/album-{album}', 'GalleryController@album');
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');

Route::get('/regulamin', 'HomeController@terms');

Route::get('/polityka-prywatnosci', 'HomeController@privacy');

Route::post('/', 'HomeController@checkUsername');

Route::post('/kontakt', 'EmailController@sendToAdmin');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// ADMIN

Route::group(['middleware' => ['admin']], function () {
   Route::get('/admin/settings', 'Admin\AdminController@settings')->name('admin.settings');
   Route::get('/admin/users', 'Admin\AdminController@users')->name('admin.users');
});

//PANEL

Route::get('/panel', 'SettingsController@index');

Route::put('/panel/settings', 'SettingsController@updateUserSettings');

Route::put('/panel/aboutme', 'SettingsController@updateAboutMe');

Route::post('/panel/header', 'SettingsController@updateHeaderImage');

Route::get('/panel', function () {
   return view('user.settings');
});

Route::get('/panel/about-me', function () {
   return view('user.aboutMe');
});

Route::get('/panel/header', function () {
   return view('user.headerImage');
});

Route::get('/panel/colors', function () {
   return view('user.colors');
});

Route::get('/panel/photos/delete', function () {
   return view('user.deletePhotos');
});

// PHOTOS

Route::get('/panel/photos', 'PhotoController@index');

Route::post('/panel/photos', 'PhotoController@store');

Route::post('/panel/photos/delete', 'PhotoController@destroy');

Route::put('/panel/photos', 'PhotoController@addTitles');

Route::get('/panel/photo/{photo}/edit', function () {
   return redirect('/panel/photos');
});

Route::post('/panel/photo/{photo}/edit', 'PhotoController@update');

Route::get('/panel/photo/{photo}/changeAlbum', function () {
   return redirect('/panel/photos');
});

Route::post('/panel/photo/{photo}/changeAlbum', 'PhotoController@changeAlbum');

// albums

Route::get('/panel/albums', 'AlbumController@index');

Route::post('/panel/albums', 'AlbumController@store');

Route::get('/panel/album/{album}', 'AlbumController@show');

Route::get('/panel/album/{album}/delete', 'AlbumController@destroy');

Route::get('/panel/album/{album}/edit', 'AlbumController@edit');

Route::put('/panel/album/{album}/edit', 'AlbumController@update');

// GALLERY

// Route::get('/{username}', 'GalleryController@index');

// Route::get('/{username}/o-mnie', 'GalleryController@aboutMe');

// Route::get('/{username}/kontakt', 'GalleryController@contact');

// Route::post('/{username}/kontakt', 'EmailController@sendToUser');

// Route::get('/{username}/album-{album}', 'GalleryController@album');