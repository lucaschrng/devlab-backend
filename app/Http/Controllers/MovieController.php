<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function show($movie_id)
    {
        $movie = Http::get('https://api.themoviedb.org/3/movie/' . $movie_id . '?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
        $people = Http::get('https://api.themoviedb.org/3/movie/' . $movie_id . '/credits?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
        return view('movie', [
            'movie' => $movie->json(),
            'people' => $people->json(),
        ]);
    }
}
