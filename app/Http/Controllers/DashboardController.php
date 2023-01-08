<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumsMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function show() {
        $albums = Album::where('user_id', Auth::user()->id)->get();
        foreach ($albums as $album) {
            $first_movie = AlbumsMovie::where('album_id', $album->id)->get();
            if (isset($first_movie[0])) {
                $cover_path = Http::get('https://api.themoviedb.org/3/movie/' . $first_movie[0]->movie_id . '?api_key=' . $_ENV['API_KEY'] . '&language=en-US')->json()['poster_path'];
                $album->cover_path = $cover_path;
            } else {
                $album->cover_path = '';
            }
        }

        return view('dashboard', [
            'albums' => $albums,
        ]);
    }
}
