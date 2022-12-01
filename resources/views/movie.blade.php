<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>wikiMovies - </title>
</head>
<body>
    <header class="z-10">
        <x-navbar />
    </header>
    <main>
        <div class="movie-section">
            <img src="<?= 'https://image.tmdb.org/t/p/original' . $movie['poster_path']; ?>" alt="">
            <div class="infos">
                <h2>{{ $movie['title'] }}</h2>
                <p>{{ date('d/m/Y', strtotime($movie['release_date'])) }}
                    @foreach ($movie['production_countries'] as $country)
                        @if ($loop->count !== 1)
                            @if ($loop->first)
                                {{ '(' . $country['iso_3166_1'] . ',' }}
                            @elseif ($loop->last)
                                {{ $country['iso_3166_1'] . ')' }}
                            @else
                                {{ $country['iso_3166_1'] . ',' }}
                            @endif
                        @else
                        {{ '(' . $country['iso_3166_1'] . ')' }}
                        @endif
                    @endforeach
                    @foreach ($movie['genres'] as $genre)
                        {{ $genre['name'] . ',' }}
                    @endforeach
                    {{ floor($movie['runtime'] / 60) . 'h' . $movie['runtime'] - floor($movie['runtime'] / 60) * 60 }}
                </p>
                <div>
                    <h3>Overview</h3>
                    <p>{{ $movie['overview'] }}</p>
                </div>
                <div>
                    <h3>Cast</h3>
                    <ul>
                        @foreach($people['cast'] as $actor)
                            @if($loop->index < 5)
                                <li>
                                    <img src="https://image.tmdb.org/t/p/w300{{ $actor['profile_path'] }}" alt="">
                                    <h3>{{ $actor['name'] }}<br>{{ $actor['character'] }}</h3>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <script src="/js/app.js"></script>
</body>
</html>
