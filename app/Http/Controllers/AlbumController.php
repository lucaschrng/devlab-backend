<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function getUserAlbum($user_id){
        $album = \App\Models\Album::where('user_id',$user_id)->get();
        //$album = Album::all();

        dump($album);
        return view('dashboard', ["albums"=>$album]);


    }
}
