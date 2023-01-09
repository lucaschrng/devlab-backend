<?php
$user = \Illuminate\Support\Facades\Auth::user();

?>

<x-layout>
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css"/>
    <main class="sm:p-24 max-sm:p-6">
        <div class="relative flex flex-row justify-start items-center gap-4 w-min">
            <h1 class="text-3xl font-semibold">{{ $album->name }}</h1>

            <input type="hidden" value="{{ $album->id }}" class="album-id">
            @if(Auth::check())
                <input type="hidden" class="user-id" value="{{ Auth::user()->id }}">
            @endif
            <input type="hidden" class="is-liked" value="{{ $isLiked ? 1:0 }}">

            @if($album->is_public)
                <div class="flex text-red-500 items-center">
                    <span class="likes text-xl font-semibold opacity-70">{{ $likes }}</span>
                        @if(Auth::check())
                            <ion-icon name="heart{{ $isLiked ? '':'-outline' }}" class="like-button text-3xl opacity-70 cursor-pointer"></ion-icon>
                        @else
                            <a href="{{ url('') . '/login' }}" class="flex items-center"><ion-icon name="heart-outline" class="text-3xl opacity-70 cursor-pointer"></ion-icon></a>
                        @endif
                </div>
            @endif

            @if(Auth::check())
                @if(Auth::user()->id == $album->user_id)
                    <ion-icon name="settings-outline" class="settings-album text-3xl opacity-50 cursor-pointer"></ion-icon>

                    <div class="settings-span bg-lighter-bg p-4 flex flex-col gap-2 hidden z-20 absolute ml-4 top-0 left-full justify-center items-start rounded">
                        <h3 class="text-xl font-semibold text-accent mb-4">Options</h3>
                        <div class="flex flex-row justify-between w-full">
                            <p class="text-lg text-white/80">Public</p>
                            <label for="toggle-example" class="flex items-center cursor-pointer relative">
                                <input type="checkbox" id="toggle-example" class="sr-only" {{ $album->is_public ? 'checked':'' }}>
                                <div class="toggle-bg bg-gray-500 border-2 border-gray-500 h-6 w-11 rounded-full "></div>
                            </label>
                        </div>


                        <form action="{{route('delete')}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" value="{{ $album->id }}" name="album_id" class="album-id">
                            <input type="submit" value="Delete Album"
                                   class="px-12 py-2 bg-red-500 text-red-600 text-lg bg-opacity-30 rounded mt-4 cursor-pointer">
                        </form>
                    </div>
                    <ion-icon name="share-outline" size="large" class="share-icon"></ion-icon>
                    <div  class="share-span bg-lighter-bg p-4 gap-4 flex flex-col gap-4 hidden z-20 absolute ml-60 top-28
            justify-center items-start">
                        <p>Share</p>
                        <input type="text" class="search-input text-black">

                        <form class="resultsUser" action="{{route("share")}}" method="post" >
                            @csrf
                            <div class="share-users-results"></div>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input type="hidden" name="album_id" value="{{$album->id}}">
                        </form>
                    </div>
                @else
                    <input type="hidden" value="{{ $album->id }}" name="album_id" class="album-id">
                @endif
            @endif

        </div>
        <a href="{{ url('') . '/user/' . $username }}" class="text-xl text-white/60 hover:underline">{{ 'by @' . $username }}</a>

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
