
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
        <div class=" flex flex-row justify-start items-center">
            <h2 class="underline decoration-accent text-3xl  m-10">My Albums</h2>

            <ion-icon name="add-circle-outline" class="text-accent add-album " size="large"></ion-icon>

            <div class=" flex flex-col items-start justify-start gap-2 bg-white text-black p-6 ml-6 create-album hidden">
                <h3 class="text-black">Create a new album</h3>

                <form  action='{{ route('add')}}' method="POST" class="flex-col flex">
                    @csrf
                    <input type="text" name="albumname"  placeholder="Choose a name for your album">
                    <input type="hidden" name="user_id" value="{{$user["id"]}}">
                    <label for="status">Private</label>
                    <input type="radio" name="status" id="" value="0">
                    <label for="status">Public</label>
                    <input type="radio" name="status" id="" value="1">
                    <input type="submit" value="Create" >
                </form>

            </div>

        </div>
        <div id="myAlbums" class="flex flex-row gap-2 m-10 w-2/12 flex-wrap">

            @foreach($albums as $album)
                <a href="/album/{{ $album['id'] }}">
                    <div class="flex flex-col justify-center items-center  w-fit m-4 gap-6">
                        <div >
                            <div class="flex relative">
                                <img src="https://image.tmdb.org/t/p/original/hBcY0fE9pfXzvVaY4GKarweriG2.jpg" alt="" class=" object-cover z-50">
                                <div class='absolute w-full h-full bg-gray-700 shadow-[0_0_2px_-1px_rgba(0,0,0,1)] ml-4 -mt-4 z-10'></div>
                                <div class='absolute w-full h-full bg-gray-600  ml-2 -mt-2 z-20'></div>



                            </div>
                        </div>


                        <div class="flex flex-row justify-center items-center gap-1">
                            <h2>{{$album["name"]}}</h2>

                            @if($album["is_public"])
                                <ion-icon name="lock-open-outline"></ion-icon>
                            @else
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach

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


<?php


?>
