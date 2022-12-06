<x-layout>
    <main>
        <div class="flex flex-row m-10 justify-start items-center gap-4 w-fit ">
            <h1 class="underline decoration-accent text-xl">Visionnés</h1>
            <ion-icon name="settings-outline" class="settings-album" size="large"></ion-icon>

            <div class="settings-span bg-lighter-bg p-4 gap-4 flex flex-col gap-4 hidden z-20 absolute ml-40 mt-20 ">
                <p class="text-accent text-lg">Options</p>
                    <div class="flex flex-row gap-4">
                        <p>Public</p>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="rounded"></span>
                        </label>

                    </div>
                <form action="">
                    <input type="submit" value="DELETE ALBUM" class="px-6 bg-red-600 text-red-800">
                </form>
            </div>

        </div>

        @foreach($movies as $movie)
            <div class="w-2/6 m-10 flex flex-col justify-center items-center gap-4">
            <img src="https://image.tmdb.org/t/p/original/hBcY0fE9pfXzvVaY4GKarweriG2.jpg" alt="">
            <h1>{{$movie["movieName"]}}</h1>
            </div>
        @endforeach
    </main>
    <script src="/js/album.js"></script>
</x-layout>
