<x-layout>
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css" />
    <main>
        <div class="flex flex-row m-10 justify-start items-center gap-4 w-fit ">
            <h1 class="underline decoration-accent text-xl">Visionnés</h1>
            <ion-icon name="settings-outline" class="settings-album" size="large"></ion-icon>

            <div  class="settings-span bg-lighter-bg p-4 gap-4 flex flex-col gap-4 hidden z-20 absolute ml-40 top-28
            justify-center items-start">
                <p class="text-accent text-xl">Options</p>
                    <div class="flex flex-row gap-6">
                        <p>Public</p>
                        <label for="toggle-example" class="flex items-center cursor-pointer relative mb-4">
                            <input type="checkbox" id="toggle-example" class="sr-only">
                            <div class="toggle-bg bg-gray-500 border-2 border-gray-500 h-6 w-11 rounded-full "></div>
                        </label>

                    </div>
                <form action="">
                    <input type="submit" value="Delete Album" class="px-12 py-2 bg-red-500 text-red-600 text-lg bg-opacity-30">
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
