<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumInvite;
use App\Models\User;
use Illuminate\Http\Request;


class AlbumsInvitesController extends Controller
{
    public function create(Request $request){
        AlbumInvite::create([
            "album_id"=>$request->input('album_id'),
            "user_id"=>$request->input('user_id'),
            "invited_id"=>$request->input('invited_id'),
            "accepted"=>false
        ]);

        $allALbums=\App\Models\Album::where('id',$request->input('album_id'))->get();
        return view('dashboard');
    }

    public function put(Request $request){
        $invite = \App\Models\AlbumInvite::find($request["invite_id"]);



        if(!$invite){
            return response("Not Found",404);
        }


        $invite->accepted=1;
        $invite->update();

        return view('dashboard',[
          "invited"=>$invite,
        ]);
    }

    public function delete(Request $request){
        $invite = AlbumInvite::find($request->input("invite_id"));
        if(!$invite){
            return response("Not Found",404);
        }
        $invite->delete();
        return redirect('dashboard');
    }

}
