<x-layout>
    <main class="p-24 max-sm:px-6">
        <div class="flex items-center gap-6">
            <h2 class="text-4xl font-medium">Hi, {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} !</h2>
            <ion-icon name="mail" class="text-3xl opacity-50 hover:opacity-100 hover:cursor-pointer"></ion-icon>

<?php
$user = \Illuminate\Support\Facades\Auth::user();
$albums = \App\Models\Album::where('user_id',$user['id'])->get();

use App\Http\Controllers\AlbumController;
use App\Models\Album;


$invites=\App\Models\AlbumInvite::where('invited_id',$user["id"])->get();



?>
<x-layout>
    <main>
        <div class="flex flex-row  justify-start items-center">
            <h2 class="text-3xl m-10"> Hi {{$user['username']}} !</h2>
            <ion-icon name="mail-unread-outline" class="text-accent mail-icon" size="large"></ion-icon>

            <div class="flex flex-col items-start justify-start gap-2 bg-white text-black p-6 ml-6 notifications hidden">
                <p class="text-accent">Notifications</p>
                <div>
                    @foreach($invites as $invite)
                        @if($invite['accepted']===0)
                        <p>{{$invite->user->username}} wants to share {{$invite->album->name}} with you !</p>
                            <form action="{{route('share.put')}}" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="invite_id" value="{{$invite["id"]}}">
                                <input type="hidden" name="invite_id" value="{{$invite["album_id"]}}">
                                <input type="submit" value="Accept">
                            </form>

                            <form action="{{route('share.delete')}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" value="{{$invite['id']}}" name="invite_id">
                                <input type="submit" value="Decline" class="px-12 py-2 bg-red-500 text-red-600 text-lg bg-opacity-30">
                            </form>


                        @endif
                    @endforeach
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
                    <form  action='{{ route('add')}}' method="POST" class="flex-col flex">
                        @csrf
                        <input type="text" name="albumname" class="text-black" placeholder="Choose a name for your album">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <label for="status">Private</label>
                        <input type="radio" name="status" id="" value="0">
                        <label for="status">Public</label>
                        <input type="radio" name="status" id="" value="1">
                        <input type="submit" value="Create" class="text-center font-semibold text-white/60 bg-white/10 hover:bg-white/20 p-2 rounded w-full cursor-pointer">
                    </form>
                </div>
            </div>
            <div class="flex flex-wrap justify-between gap-x-6 max-w-full mt-10">
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

        <h2>Shared Albums</h2>
        <div id="sharedAlbums" class="flex flex-row gap-2 m-10 w-2/12 flex-wrap">


                @foreach($albums as $albumes)

                <a href="/album/{{$albumes->id}}">
                    <div class="flex flex-col justify-center items-center  w-fit m-4 gap-6">
                        <div >
                            <div class="flex relative">
                                <img src="https://image.tmdb.org/t/p/original/hBcY0fE9pfXzvVaY4GKarweriG2.jpg" alt="" class=" object-cover z-50">
                                <div class='absolute w-full h-full bg-gray-700 shadow-[0_0_2px_-1px_rgba(0,0,0,1)] ml-4 -mt-4 z-10'></div>
                                <div class='absolute w-full h-full bg-gray-600  ml-2 -mt-2 z-20'></div>



                            </div>
                        </div>


                        <div class="flex flex-row justify-center items-center gap-1">
                            <h2>{{$albumes->name}}</h2>

                            @if($albumes->is_public === true)
                                <ion-icon name="lock-open-outline"></ion-icon>
                            @else
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            @endif
                        </div>
                    </div>
                </a>

            @endforeach
        </div>


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="Log Out">
        </form>
    </main>
    <script src="/js/album.js"></script>
</x-layout>
