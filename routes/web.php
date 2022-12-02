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

Route::get('/', function () {
    return view('home');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::get('/login', function () {
    return view('login');
});


//USER

///AJOUTER UN NOUVEAUX USER
//Route::post('/user',[\App\Http\Controllers\UserController::class,"createUser"])->name('user.store');
Route::get('/user/{email}',[\App\Http\Controllers\UserController::class,"authenticate"])->name('user.connect');
