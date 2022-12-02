<x-layout>
    <main>
        <div class="px-24 animate-fade">
            <div class="w-full left-0 top-full mt-20">
                <div class="flex justify-between text-2xl">
                    <h2 class="text-white text-opacity-50">Results for: <span class="query text-accent">{{ $genre }}</span></h2>
                    <div class="flex gap-6">
                    </div>
                </div>
            </div>
            <div class="results flex flex-wrap justify-between gap-6 max-w-full mt-10">
                @foreach($movies['results'] as $movie)
                    <div class="min-w-[250px] max-w-[250px] mt-10">
                        <a href="/movie/{{ $movie['id'] }}">
                            <img class="rounded" src="https://image.tmdb.org/t/p/w300/{{ $movie['poster_path'] }}">
                        </a>
                        <a class="flex flex-col items-center mt-2 text-xl font-medium" href="/movie/{{ $movie['id'] }}">
                            <span class="max-w-full whitespace-nowrap overflow-hidden text-ellipsis">{{ $movie['title'] }}</span>
                            <span class="opacity-40">{{ is_null($movie['release_date']) ? 'TBD':substr($movie['release_date'], 0, 4) }}</span>
                        </a>
                    </div>
                @endforeach
                @for($i = 0; $i < 8; $i++)
                    <div class="min-w-[250px] max-w-[250px] h-0"></div>
                @endfor
            </div>
            <div class="flex justify-center my-12 gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    @if($page <= 2)
                        <a href="{{ $i }}" class="{{ $i == $page ? 'bg-lighter-bg':'' }} text-xl rounded-full w-[3rem] leading-[3rem] h-[3rem] text-center hover:bg-lighter-bg">{{ $i }}</a>
                    @elseif($page > 498)
                        <a href="{{ $i + 495 }}" class="{{ $i + 495 == $page ? 'bg-lighter-bg':'' }} text-xl rounded-full w-[3rem] leading-[3rem] h-[3rem] text-center hover:bg-lighter-bg">{{ $i + 495 }}</a>
                    @else
                        <a href="{{ $i + $page - 3 }}" class="{{ $i + $page - 3 == $page ? 'bg-lighter-bg':'' }} text-xl rounded-full w-[3rem] leading-[3rem] h-[3rem] text-center hover:bg-lighter-bg">{{ $i + $page - 3 }}</a>
                    @endif
                @endfor
            </div>
        </div>
    </main>
</x-layout>
