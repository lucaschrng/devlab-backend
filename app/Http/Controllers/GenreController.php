<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenreController extends Controller
{
    public function show($genre_id, $page){
        $request = Http::get('https://api.themoviedb.org/3/discover/movie?api_key=' . $_ENV['API_KEY'] . '&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=' . $page . '&with_genres=' . $genre_id . '&with_watch_monetization_types=flatrate');
        $movies = $request->json();
        $request = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
        $genres = collect($request->json()['genres'])->where('id', $genre_id)->first()['name'];
        return view('genre', [
            'movies' => $movies,
            'genre' => $genres,
            'page' => $page
        ]);
    }
}
