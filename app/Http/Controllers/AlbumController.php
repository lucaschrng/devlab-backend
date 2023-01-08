<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function show($album_id){

        //return view('album');
        $movies = \App\Models\AlbumsMovie::where('album_id',$album_id)->get();
        return view('album', ["movies"=>$movies,'album'=>$album_id]);


    }

    public function delete(Request $request){
        $album = \App\Models\Album::find($request->input('album_id'));
        if(!$album){
            return response("Not Found",404);
        }
        $album->delete();
        return redirect('dashboard');


    }

    public function created(Request $request){
        dump("irjfoierjfioerjfoeirjfoier");

        Album::create([
            "name"=>$request->input('albumname'),
            "user_id"=>$request->input('user_id'),
            "is_public"=>true
        ]);
        return redirect('dashboard');
    }
}
