<x-layout>
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css"/>
    <main class="p-24">
        <div class="flex flex-row justify-start items-center gap-4 w-fit ">
            <h1 class="text-3xl font-semibold">{{ $album->name }}</h1>
            <ion-icon name="settings-outline" class="settings-album text-3xl opacity-50 cursor-pointer"></ion-icon>

            <div class="settings-span bg-lighter-bg p-4 gap-4 flex flex-col gap-4 hidden z-20 absolute ml-60 top-28
            justify-center items-start">
                <p class="text-accent text-xl">Options</p>
                <div class="flex flex-row gap-6">
                    <p>Public</p>
                    <label for="toggle-example" class="flex items-center cursor-pointer relative mb-4">
                        <input type="checkbox" id="toggle-example" class="sr-only" {{ $album->is_public ? 'checked':'' }}>
                        <div class="toggle-bg bg-gray-500 border-2 border-gray-500 h-6 w-11 rounded-full "></div>
                    </label>
                </div>

                <div class="flex flex-col gap-4 ">
                    <div class="flex flex-row items-center justify-center gap-6">
                        <p>Share</p>
                        <ion-icon name="share-outline" size="medium"></ion-icon>
                    </div>
                </div>
                <form action="{{route('delete')}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{ $album->id }}" name="album_id" class="album-id">
                    <input type="submit" value="Delete Album"
                           class="px-12 py-2 bg-red-500 text-red-600 text-lg bg-opacity-30">
                </form>
            </div>

        </div>

        <div class="flex flex-wrap justify-between gap-x-6 max-w-full mt-10">
            @foreach($movies as $movie)
                <div class="min-w-[250px] max-w-[250px] mt-20 transition-all duration-300">
                    <a href="/movie/{{ $movie->movie_id }}">
                        <img class="rounded" src="https://image.tmdb.org/t/p/w300/{{ $movie->poster_path }}">
                    </a>
                    <a class="flex flex-col items-center mt-2 text-xl font-medium" href="/movie/{{ $movie->movie_id }}">
                        <span class="max-w-full whitespace-nowrap overflow-hidden text-ellipsis">{{ $movie->title }}</span>
                        <span class="opacity-40">{{ $movie->date }}</span>
                    </a>
                </div>
            @endforeach
            @for($i = 0; $i <= 10; $i++)
                <div class="min-w-[250px] max-w-[250px]"></div>
            @endfor
        </div>
    </main>
    <script src="/js/album.js"></script>
</x-layout>
