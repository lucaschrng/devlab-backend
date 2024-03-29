<x-layout>
    <main class="p-24 max-sm:px-6">
        <h2 class="text-4xl font-medium">{{ $user->firstName }} {{ $user->lastName }}</h2>
        <h3 class="text-xl text-white/60">{{ '@' . $user->username }}</h3>
        <div class="mt-24">
            <h2 class="text-3xl font-medium">Public albums:</h2>
            <div class="flex flex-wrap justify-between gap-x-6 max-w-full">
                @foreach($albums as $album)
                    <a href="/album/{{ $album['id'] }}">
                        <div class="min-w-[250px] max-w-[250px] mt-20 transition-all duration-300">
                            <div >
                                <div class="flex relative">
                                    @if($album->cover_path == '')
                                        <div class="flex h-full justify-center items-center text-center w-full h-[375px] rounded bg-white/30 text-3xl font-semibold">
                                            Empty
                                        </div>
                                    @else
                                        <img src="https://image.tmdb.org/t/p/w300/{{ $album->cover_path }}" alt="" class="object-cover z-10 rounded">
                                    @endif
                                    <div class='absolute w-full h-full bg-white/20 shadow-[0_0_2px_-1px_rgba(0,0,0,1)] ml-4 -mt-4 rounded'></div>
                                    <div class='absolute w-full h-full bg-white/20  ml-2 -mt-2 rounded'></div>
                                </div>
                            </div>
                            <div class="flex flex-row justify-center items-center gap-2 mt-4 text-xl font-medium">
                                <h2>{{$album["name"]}}</h2>
                                @if($album["is_public"])
                                    <ion-icon name="lock-open" class="opacity-50"></ion-icon>
                                @else
                                    <ion-icon name="lock-closed" class="opacity-50"></ion-icon>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
                @for($i = 0; $i <= 10; $i++)
                    <div class="min-w-[250px] max-w-[250px]"></div>
                @endfor
            </div>
        </div>
        <div class="mt-24">
            <h2 class="text-3xl font-medium">Liked albums:</h2>
            <div class="flex flex-wrap justify-between gap-x-6 max-w-full">
                @foreach($likedAlbums as $album)
                    @if($album->album->is_public)
                    <a href="/album/{{ $album->album->id }}">
                        <div class="min-w-[250px] max-w-[250px] mt-20 transition-all duration-300">
                            <div >
                                <div class="flex relative">
                                    @if($album->album->cover_path == '')
                                        <div class="flex h-full justify-center items-center text-center w-full h-[375px] rounded bg-white/30 text-3xl font-semibold">
                                            Empty
                                        </div>
                                    @else
                                        <img src="https://image.tmdb.org/t/p/w300/{{ $album->album->cover_path }}" alt="" class="object-cover z-10 rounded">
                                    @endif
                                    <div class='absolute w-full h-full bg-white/20 shadow-[0_0_2px_-1px_rgba(0,0,0,1)] ml-4 -mt-4 rounded'></div>
                                    <div class='absolute w-full h-full bg-white/20  ml-2 -mt-2 rounded'></div>
                                </div>
                            </div>
                            <div class="flex flex-row justify-center items-center gap-2 mt-4 text-xl font-medium">
                                <h2>{{$album->album->name}}</h2>
                                <ion-icon name="lock-open" class="opacity-50"></ion-icon>
                            </div>
                        </div>
                    </a>
                    @endif
                @endforeach
                @for($i = 0; $i <= 10; $i++)
                    <div class="min-w-[250px] max-w-[250px]"></div>
                @endfor
            </div>
        </div>
        <div class="mt-24">
            <h2 class="text-3xl font-medium">Shared albums:</h2>
            <div class="flex flex-wrap justify-between gap-x-6 max-w-full">
                @foreach($sharedAlbums as $album)
                    @if($album->album->is_public)
                        <a href="/album/{{ $album->album->id }}">
                            <div class="min-w-[250px] max-w-[250px] mt-20 transition-all duration-300">
                                <div >
                                    <div class="flex relative">
                                        @if($album->album->cover_path == '')
                                            <div class="flex h-full justify-center items-center text-center w-full h-[375px] rounded bg-white/30 text-3xl font-semibold">
                                                Empty
                                            </div>
                                        @else
                                            <img src="https://image.tmdb.org/t/p/w300/{{ $album->album->cover_path }}" alt="" class="object-cover z-10 rounded">
                                        @endif
                                        <div class='absolute w-full h-full bg-white/20 shadow-[0_0_2px_-1px_rgba(0,0,0,1)] ml-4 -mt-4 rounded'></div>
                                        <div class='absolute w-full h-full bg-white/20  ml-2 -mt-2 rounded'></div>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-center items-center gap-2 mt-4 text-xl font-medium">
                                    <h2>{{$album->album->name}}</h2>
                                    <ion-icon name="lock-open" class="opacity-50"></ion-icon>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
                @for($i = 0; $i <= 10; $i++)
                    <div class="min-w-[250px] max-w-[250px]"></div>
                @endfor
            </div>
        </div>
    </main>
</x-layout>
