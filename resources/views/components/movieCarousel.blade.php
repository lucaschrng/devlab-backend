@props([
    'title',
    'movies',
])

<div>
    <h2 class="px-24 max-sm:px-6 text-3xl font-medium">{{ $title }}</h2>
    <div class="carousel grid items-center">
        <ion-icon name="chevron-back-outline" class="previous-button ml-6 p-3 text-3xl rounded-full col-overlap row-overlap cursor-pointer bg-black/70 backdrop-blur z-10"></ion-icon>
        <ion-icon name="chevron-forward-outline" class="next-button mr-6 p-3 text-3xl rounded-full col-overlap row-overlap cursor-pointer bg-black/70 backdrop-blur justify-self-end z-10"></ion-icon>
        <div class="best-movies px-24 max-sm:px-6 flex max-w-full overflow-hidden gap-6 col-overlap row-overlap">
            @foreach($movies as $movie)
                <div class="min-w-[250px] mt-10 transition-all duration-300">
                    <a href="/movie/{{ $movie['id'] }}">
                        <img class="rounded" src="https://image.tmdb.org/t/p/w300/{{ $movie['poster_path'] }}">
                    </a>
                    <a class="flex flex-col items-center mt-2 text-xl font-medium" href="/movie/{{ $movie['id'] }}">
                        <span class="max-w-full whitespace-nowrap overflow-hidden text-ellipsis">{{ $movie['title'] }}</span>
                        <span class="opacity-40">{{ is_null($movie['release_date']) ? 'TBD':substr($movie['release_date'], 0, 4) }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
