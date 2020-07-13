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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// formulario para crear una entrada
Route::get('/entries/create', 'EntryController@create');
// crea la entrada (graba)
Route::post('/entries', 'EntryController@store');

// ver una entrada
Route::get('/entries/{entryBySlug}', 'GuestController@show');

// editar una entrada
Route::get('/entries/{entry}/edit', 'EntryController@edit');
    // ->middleware('can:update,entry');

// actualizar una entrada
Route::put('/entries/{entry}', 'EntryController@update');
    // ->middleware('can:update,entry');

Route::get('/users/{user}', 'UserController@show');
