<?php

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

/*Route::get('user/{email}',function ($email){
    //\App\Http\Controllers\UserController::class("authenticate");
    \App\Http\Controllers\UserController::authenticate($email);
});*/

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
