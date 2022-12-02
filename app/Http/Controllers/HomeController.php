<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function show(){
        $request = Http::get('https://api.themoviedb.org/3/discover/movie?api_key=' . $_ENV['API_KEY'] . '&language=en-US&sort_by=vote_average.desc&include_adult=false&include_video=false&page=1&vote_count.gte=10000&with_watch_monetization_types=flatrate');
        $popularMovies = $request->json()['results'];
        $request = Http::get('https://api.themoviedb.org/3/discover/movie?api_key=' . $_ENV['API_KEY'] . '&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&vote_count.gte=2000&primary_release_date.gte=' . date('Y-m-d', strtotime("-1 years")) . '&with_watch_monetization_types=flatrate');
        $trendingMovies = $request->json()['results'];
        return view('home', [
            'popularMovies' => $popularMovies,
            'trendingMovies' => $trendingMovies,
        ]);
    }
}
