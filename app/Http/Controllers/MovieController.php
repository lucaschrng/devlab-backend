<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumsMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function show($movie_id)
    {
        $movie = Http::get('https://api.themoviedb.org/3/movie/' . $movie_id . '?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
        $people = Http::get('https://api.themoviedb.org/3/movie/' . $movie_id . '/credits?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
        $albums = [];
        if (Auth::check()) {
            $albums = Album::where('user_id', Auth::user()['id'])->get();
            foreach ($albums as $album) {
                $album->isAdded = AlbumsMovie::where('album_id', $album->id)->where('movie_id', $movie_id)->get()->count() > 0;
            }
        }

        return view('movie', [
            'movie' => $movie->json(),
            'actors' => $people->json()['cast'],
            'directors' => collect($people->json()['crew'])->where('job', 'Director')->all(),
            'albums' => $albums,
        ]);
    }
}
