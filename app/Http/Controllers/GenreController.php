<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenreController extends Controller
{
    public function show($genre, $filter, $page)
    {
        switch ($filter) {
            case 'popularity':
                $filter_parameter = 'popularity.desc';
                break;
            case 'alphabetical':
                $filter_parameter = 'original_title.asc';
                break;
            case 'ratings':
                $filter_parameter = 'vote_average.desc';
                break;
        }
//        @dd(strtolower(str_replace('-', ' ', $genre)));
        $request = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . $_ENV['API_KEY'] . '&language=en-US');
//        @dd(collect($request->json()['genres'])->filter(function ($item) {
//            return strtolower($item['name']) == 'tv movie';
//        }));
        $genre = collect($request->json()['genres'])->filter(function ($item) use ($genre) {
            return strtolower($item['name']) == strtolower(str_replace('-', ' ', $genre));
        })->first();
        $request = Http::get('https://api.themoviedb.org/3/discover/movie?api_key=' . $_ENV['API_KEY'] . '&language=en-US&sort_by=' . $filter_parameter . '&include_adult=false&include_video=false&page=' . $page . '&with_genres=' . $genre['id'] . '&with_watch_monetization_types=flatrate');
        $movies = $request->json();
        return view('genre', [
            'movies' => $movies,
            'genre' => $genre['name'],
            'filter' => $filter,
            'page' => $page,
            'total_pages' => min($movies['total_pages'], 500)
        ]);
    }
}
