<x-layout>
    <main class="py-24 flex flex-col gap-24">
        <x-movieCarousel title="Popular movies" :movies="$popularMovies"/>
        <x-movieCarousel title="Trending movies" :movies="$trendingMovies"/>
        <div>
            <h2 class="px-24 max-sm:px-6 text-3xl font-medium">Discover by genre</h2>
            <div class="grid grid-cols-3 max-lg:grid-cols-2 max-sm:grid-cols-1 gap-2 px-24 max-sm:px-6 pt-10">
                @foreach($genres as $genre)
                    <a href="/genre/{{ str_replace(' ', '-', strtolower($genre['name'])) }}/popularity/1" class="text-center bg-lighter-bg text-2xl font-semibold p-6 rounded">{{ $genre['name'] }}</a>
                @endforeach
            </div>
        </div>
    </main>
</x-layout>
