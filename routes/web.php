<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth; // per Auth riga 20

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

Route::get('/', 'HomeController@index')->name('home');

Route::name('guest.')
    ->group(function() {
        Route::get('/show/{slug}', 'HomeController@show')->name('infos.show');
        // Route::post('/show/{slug}', 'HomeController@store')->name('review.store');
    });

Route::resource('reviews', 'ReviewController');
Route::resource('messages', 'MessageController');


Auth::routes();

//rotta per home
//Route::get('/', 'HomeController@index')->name('home');

//rotta privata
Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function() {
        //home Admin
        Route::get('/', 'HomeController@index')->name('home');
        // route Sponsor
        Route::get('/sponsor', 'HomeController@sponsor')->name('sponsor');
        // route stats
        Route::get('/stats', 'HomeController@stats')->name('stats');
        

        //rotte info CRUD
        Route::resource('infos', 'InfoController');

        // Rotta avvenuto pagamento
        Route::get('/payed', 'HomeController@payed')->name('payed');
    });
