<?php

use App\Models\Album;
use App\Models\AlbumsLike;
use App\Models\AlbumsMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// GET ALL USERS
Route::get('/user',function (){
    return \App\Models\User::all();
});

// SEARCH USER
Route::get('/search/user/{query}',function ($query){
    return \App\Models\User::where('username', 'like', '%' . $query . '%')->orWhere('email', 'like', '%' . $query . '%')->orWhere('firstName', 'like', '%' . $query . '%')->orWhere('lastName', 'like', '%' . $query . '%')->get();
});

///AJOUTER UN NOUVEAUX USER
Route::post('/user',function (){
    request()->validate([
        'username'=>'required',
        'email'=>'required',
        'firstName'=>'required',
        'lastName'=>'required',
        'password'=>'required'

    ]);
    $data =request()->all();

    $user =new \App\Models\User();

    $user->username=$data["username"];
    $user->email=$data["email"];
    $user->firstName=$data["firstName"];
    $user->lastName=$data["lastName"];
    $user->password=$data["password"];


    $user->save();
});
// SUPPRIMER UN USER
Route::delete('/user/{id}',function ($id){
    $user = \App\Models\User::find($id);
    if(!$user){
        return response("Not Found",404);
    }
    $user->delete();
    return response(":)",200);
});

// MODIFIER UN USER
Route::put('/user/{id}',function ($id){
    $user = \App\Models\User::find($id);
    if(!$user){
        return response("Not Found",404);
    }
    request()->validate([
        'username'=>'required',
        'email'=>'required',
        'firstName'=>'required',
        'lastName'=>'required',
        'password'=>'required'
    ]);
    $data =request()->only(['nom','image_url','description','programme','year','date_debut','date_fin']);
    $user->update($data);
});

Route::post('/add-movie', function () {
    $data = request()->all();
    $albumMovie = new AlbumsMovie;

    $albumMovie->album_id = $data['album_id'];
    $albumMovie->movie_id = $data['movie_id'];

    $albumMovie->save();
});

Route::delete('/add-movie', function () {
    $data = request()->all();
    $albumMovie = AlbumsMovie::where('album_id', $data['album_id'])->where('movie_id', $data['movie_id'])->get();
    foreach ($albumMovie as $album) {
        $album->delete();
    }
});

Route::put('/album/{albumId}', function ($albumId) {
    $album = Album::find($albumId);
    $data = request()->all();

    $album->is_public = $data['isPublic'];
    $album->update();
});

Route::post('/like', function () {
   $data = request()->all();
   $like = new AlbumsLike;

   $like->album_id = $data['album_id'];
   $like->user_id = $data['user_id'];

   $like->save();
});

Route::delete('/like', function () {
    $data = request()->all();
    $likes = AlbumsLike::where('album_id', $data['album_id'])->where('user_id', $data['user_id'])->get();
    foreach ($likes as $like) {
        $like->delete();
    }
});
