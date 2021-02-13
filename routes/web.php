<?php

use Illuminate\Support\Facades\Route;

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

        //rotte info CRUD
        Route::resource('infos', 'InfoController');
    });
