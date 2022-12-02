<x-layout>
    <main class="py-24 flex flex-col gap-24">
        <x-movieCarousel title="Popular movies" :movies="$popularMovies"/>
        <x-movieCarousel title="Trending movies" :movies="$trendingMovies"/>
    </main>
</x-layout>
