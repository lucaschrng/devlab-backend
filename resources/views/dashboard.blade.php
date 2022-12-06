<?php
$user = \Illuminate\Support\Facades\Auth::user();
$albums = \App\Models\Album::where('user_id',$user['id'])->get();

?>
<x-layout>
    <main>
        <div class="flex flex-row  justify-start items-center">
        <h2 class="text-3xl m-10"> Hi {{$user['username']}} !</h2>
            <ion-icon name="mail-unread-outline" class="text-accent" size="large"></ion-icon>
        </div>
        <h2 class="underline decoration-accent text-3xl  m-10">My Albums</h2>
        <div id="myAlbums" class="flex flex-row gap-5 m-10">

            @foreach($albums as $album)
                <a href="/album/{{ $album['id'] }}">
                <div class="flex flex-col justify-center items-center  w-3/6 m-10 gap-6">
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


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="Log Out">
        </form>
    </main>
    <script src="js/album.js"></script>
</x-layout>

