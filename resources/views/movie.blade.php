<x-layout>
    <main>
        <div class="flex justify-center">
            <div class="movie-section p-20 flex flex-col gap-16 max-w-[1300px] xl:flex-row">
                <img src="<?= 'https://image.tmdb.org/t/p/original' . $movie['poster_path']; ?>" alt="" class="rounded xl:w-2/5">
                <div class="infos flex flex-col justify-between gap-6">
                    <div>
                        <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                        <p class="text-lg font-medium opacity-50">{{ date('Y', strtotime($movie['release_date'])) }}
                            {{-- @foreach ($movie['production_countries'] as $country)
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
                            @endforeach --}}
                            •
                            @foreach ($movie['genres'] as $genre)
                                @if($loop->last)
                                    {{ $genre['name'] }}
                                @else
                                    {{ $genre['name'] . ',' }}
                                @endif
                            @endforeach
                            •
                            {{ floor($movie['runtime'] / 60) . 'h ' . $movie['runtime'] - floor($movie['runtime'] / 60) * 60 . 'min'}}
                            • Directed by
                            @foreach($directors as $director)
                                @if($loop->count > 1)
                                    @if($loop->remaining === 1)
                                        {{ $director['name'] . ' and' }}
                                    @elseif (!$loop->last)
                                        {{ $director['name'] . ',' }}
                                    @else
                                        {{ $director['name'] }}
                                    @endif
                                @else
                                    {{ $director['name'] }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="">
                        <h3 class="relative text-2xl font-semibold after:content-[''] after:absolute after:h-[2px] after:bottom-[-5px] after:left-0 after:w-full after:bg-white after:opacity-10">Overview</h3>
                        <p class="mt-5 text-justify">{{ $movie['overview'] }}</p>
                    </div>
                    <div>
                        <h3 class="relative text-2xl font-semibold after:content-[''] after:absolute after:h-[2px] after:bottom-[-5px] after:left-0 after:w-full after:bg-white after:opacity-10">Cast</h3>
                        <ul class="flex gap-4 mt-5">
                            @foreach($actors as $actor)
                                @if($loop->index < 5)
                                    <li>
                                        <img src="https://image.tmdb.org/t/p/w300{{ $actor['profile_path'] }}" alt="" class="rounded">
                                        <h3 class="text-sm mt-2 font-medium">{{ $actor['name'] }}<br><span class="opacity-40">{{ $actor['character'] }}</span></h3>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
