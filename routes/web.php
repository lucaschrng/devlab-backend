<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;

use App\Http\Controllers\ProfileController;


use App\Http\Controllers\UserController;
use App\Models\AlbumMovie;

use App\Http\Controllers\AlbumController;
use App\Models\Album;

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


Route::get('/', [HomeController::class, 'show']);

Route::get('/movie/{movie_id}', [MovieController::class, 'show']);

Route::get('/user/{username}', [UserController::class, 'show']);

Route::get('genre/{genre}/{filter}/{page}', [GenreController::class, 'show']);

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::get('/album/{album_id}', [\App\Http\Controllers\AlbumController::class,'show']);

Route::post("/add",[AlbumController::class,'created'])->name("add");

Route::delete('/delete',[\App\Http\Controllers\AlbumController::class,'delete'])->name("delete");
require __DIR__.'/auth.php';

Route::post('/share',[\App\Http\Controllers\AlbumsInvitesController::class,'create'])->name("share");
Route::put('/share/accept',[\App\Http\Controllers\AlbumsInvitesController::class,'accept'])->name('share.accept');
Route::delete('/share/delete',[\App\Http\Controllers\AlbumsInvitesController::class,"delete"])->name("share.delete");

Route::post("/add", [AlbumController::class, 'created'])->name("add");

Route::delete('/delete', [\App\Http\Controllers\AlbumController::class, 'delete'])->name("delete");
require __DIR__ . '/auth.php';
