<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumInvite;
use App\Models\AlbumsLike;
use App\Models\AlbumsMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function show($username)
    {
        $user = \App\Models\User::where('username', $username)->get()[0];
        $albums = Album::where('user_id', $user->id)->where('is_public', 1)->get();
        foreach ($albums as $album) {
            $first_movie = AlbumsMovie::where('album_id', $album->id)->get();
            if (isset($first_movie[0])) {
                $cover_path = Http::get('https://api.themoviedb.org/3/movie/' . $first_movie[0]->movie_id . '?api_key=' . $_ENV['API_KEY'] . '&language=en-US')->json()['poster_path'];
                $album->cover_path = $cover_path;
            } else {
                $album->cover_path = '';
            }
        }
        $liked_albums = AlbumsLike::where('user_id', $user->id)->get();
        foreach ($liked_albums as $album) {
            $first_movie = AlbumsMovie::where('album_id', $album->album->id)->get();
            if (isset($first_movie[0])) {
                $cover_path = Http::get('https://api.themoviedb.org/3/movie/' . $first_movie[0]->movie_id . '?api_key=' . $_ENV['API_KEY'] . '&language=en-US')->json()['poster_path'];
                $album->album->cover_path = $cover_path;
            } else {
                $album->album->cover_path = '';
            }
        }
        return view('user', [
            'user' => $user,
            'albums' => $albums,
            'likedAlbums' => $liked_albums,
        ]);
    }
}
