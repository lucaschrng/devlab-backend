<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenreController extends Controller
{
    public function show($genre, $page = 1){
        $request = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
        $genre_id = collect($request->json()['genres'])->where('name', ucfirst($genre))->first()['id'];
        $request = Http::get('https://api.themoviedb.org/3/discover/movie?api_key=' . $_ENV['API_KEY'] . '&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=' . $page . '&with_genres=' . $genre_id . '&with_watch_monetization_types=flatrate');
        $movies = $request->json();
        return view('genre', [
            'movies' => $movies,
            'genre' => $genre,
            'page' => $page,
            'total_pages' => $movies['total_pages'] < 500 ? $movies['total_pages']:500,
        ]);
    }
}
