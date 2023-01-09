<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumsLike;
use App\Models\AlbumsMovie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isNull;

class AlbumController extends Controller
{
    public function show($album_id){

        //return view('album');
        $movies = \App\Models\AlbumsMovie::where('album_id', $album_id)->get();
        foreach ($movies as $movie) {
            $movie_data = Http::get('https://api.themoviedb.org/3/movie/' . $movie->movie_id . '?api_key=' . $_ENV['API_KEY'] . '&language=en-US')->json();
            $movie->title = $movie_data['original_title'];
            $movie->date = date('Y', strtotime($movie_data['release_date']));
            $movie->poster_path = $movie_data['poster_path'];
        }
        $user= User::find(Album::where('id',$album_id)->get()[0]->user_id);
        $isLiked = isset(AlbumsLike::where('album_id', $album_id)->where('user_id', Auth::check() ? Auth::user()->id:'')->get()[0]);
        $likes = AlbumsLike::where('album_id', $album_id)->get()->count();
        return view('album', [
            "movies" => $movies,
            'album' => Album::where('id',$album_id)->get()[0],
            'username' => $user->username,
            'isLiked' => $isLiked,
            'likes' => $likes
        ]);
    }

    public function delete(Request $request){
        $album = \App\Models\Album::find($request->input('album_id'));
        $movies = AlbumsMovie::where('album_id', $request->input('album_id'))->get();
        if(!$album){
            return response("Not Found",404);
        }
        foreach ($movies as $movie) {
            $movie->delete();
        }
        $album->delete();
        return redirect('dashboard');


    }

    public function created(Request $request){
        Album::create([
            "name"=>$request->input('albumname'),
            "user_id"=>$request->input('user_id'),
            "is_public"=>$request->input('status')
        ]);
        return redirect('dashboard');
    }
}
