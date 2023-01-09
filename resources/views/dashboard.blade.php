<x-layout>
    <main class="p-24 max-sm:px-6">
        <div class="flex items-center gap-6">
            <h2 class="text-4xl font-medium">Hi, {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} !</h2>
            <div class="relative flex items-center">
                <ion-icon name="mail{{ $invites->count() > 0 ? '-unread':'' }}" class="mail-icon text-3xl opacity-50 hover:opacity-90 hover:cursor-pointer"></ion-icon>
                <div class="absolute left-full top-0 flex flex-col items-start justify-start gap-2 bg-lighter-bg p-6 ml-2 notifications rounded w-[300px] hidden">
                    <h3 class="text-xl font-semibold text-accent">Invites</h3>
                    <div class="flex flex-col gap-2 w-full">
                        @foreach($invites as $invite)
                            <div class="bg-white/10 p-2 rounded">
                                <p><span class="text-accent font-bold">{{'@' . $invite->user->username}}</span> wants to share <span class="text-accent font-bold">{{$invite->album->name}}</span> with you !</p>
                                <div class="w-full flex gap-2 mt-2">
                                    <form action="{{route('share.accept')}}" method="POST" class="w-1/2">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="invite_id" value="{{$invite["id"]}}">
                                        <input type="hidden" name="album_id" value="{{$invite["album_id"]}}">
                                        <button class="text-3xl flex justify-center items-center w-full bg-green-500/20 hover:bg-green-500/30 rounded p-2"><ion-icon name="checkmark-outline"></ion-icon></button>
                                    </form>

                                    <form action="{{route('share.delete')}}" method="POST" class="w-1/2">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" value="{{$invite['id']}}" name="invite_id">
                                        <button class="text-3xl flex justify-center items-center w-full bg-red-500/20 hover:bg-red-500/30 rounded p-2"><ion-icon name="close-outline"></ion-icon></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        @if($invites->count() == 0)
                                <div class="bg-white/10 p-2 rounded w-full">
                                    <p class="w-full text-center text-white/60 font-semibold">No invite</p>
                                </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <h3 class="text-xl text-white/60">{{ '@' . Auth::user()->username }}</h3>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button class="mt-4 flex gap-2 items-center text-xl opacity-50 bg-lighter-bg p-2 rounded hover:opacity-100">Log Out<ion-icon name="log-out-outline" class="text-3xl"></ion-icon></button>
        </form>
        <div class="mt-24">
            <h2 class="text-3xl font-medium">Your albums:</h2>
            <div class="relative w-fit">
                <button class="add-album mt-4 flex gap-2 items-center text-xl opacity-50 bg-lighter-bg p-2 rounded hover:opacity-100">New album<ion-icon name="add" class="text-3xl"></ion-icon></button>
                <div class="absolute sm:left-full max-sm:left-0 sm:top-0 max-sm:top-full sm:ml-4 max-sm:mt-4 flex flex-col items-start justify-start gap-2 bg-lighter-bg p-4 create-album hidden z-20 rounded">
                    <h3 class="text-xl font-semibold text-accent">Create a new album</h3>
                    <form  action='{{ route('add')}}' method="POST" class="flex-col flex gap-2">
                        @csrf
                        <input type="text" name="albumname" class="text-black" placeholder="Choose a name for your album">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <label for="status" class="flex items-center cursor-pointer relative gap-2">
                            Public album
                            <input type="checkbox" id="status" name="status" class="" value="1"/>
                        </label>
                        <input type="submit" value="Create" class="text-center font-semibold text-white/60 bg-white/10 hover:bg-white/20 p-2 rounded w-full cursor-pointer">
                    </form>
                </div>
            </div>
            <div class="flex flex-wrap justify-between gap-x-6 max-w-full mt-10">
                @foreach($albums as $album)
                    <a href="/album/{{ $album->id }}">
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
                                    @if($album->album->is_public)
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
    </main>
    <script src="/js/album.js"></script>
</x-layout>
