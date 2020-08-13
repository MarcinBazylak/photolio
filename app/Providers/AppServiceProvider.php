<?php

namespace App\Providers;

use App\User;
use App\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Builder::defaultStringLength(191);      

      View::composer('gallery.*', function ($view) {

         $user = User::where('username', Route::current()->parameter('username'))->firstOrFail();
         $albums = Album::where('user_id', $user->id)->orderBy('album_name', 'asc')->get();
         $view->with([
            'user' => $user,
            'albums' => $albums
            ]);
      });

      View::composer('user.albums', function ($view) {

         $albums = Album::where('user_id', Auth::user()->id)->orderBy('album_name', 'asc')->get();
         $view->with([
            'albums' => $albums
            ]);
      });

      View::composer('user.*', function ($view) {

         $user = User::find(Auth::user()->id);
         $view->with([
            'user' => $user
            ]);
      });

   }

}
