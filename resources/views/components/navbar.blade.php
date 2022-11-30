<nav class="flex justify-between items-center py-4 px-8 shadow-small">
    <h1 class="text-2xl font-semibold">wikiMovies</h1>
    <div class="flex items-stretch gap-4">
        <div action="/search" method="post" class="flex items-stretch min-h-full rounded bg-lighter-bg">
            <input type="checkbox" name="activate-search" id="activate-search" class="peer hidden">
            <input type="text" placeholder="Search" name="search-query" id="search-query" class="w-0 text-lg rounded bg-transparent focus:outline-none placeholder:text-neutral-400 transition-all peer-checked:w-60 peer-checked:pl-3 peer-chekced:p-2">
            <label for="activate-search" class="w-fit flex content-center items-center px-2 text-2xl cursor-pointer peer-checked:hidden">
                <ion-icon name="search-outline" class="row-overlap col-overlap"></ion-icon>
            </label>
            <label for="activate-search" class="w-fit hidden content-center items-center px-2 text-2xl cursor-pointer peer-checked:flex">
                <ion-icon name="close-outline" class="row-overlap col-overlap"></ion-icon>
            </label>
        </div>
        <a href="" class="h-10 w-10 flex items-center rounded-full bg-lighter-bg">
            <span class="w-full h-min text-center text-xl">L</span>
        </a>
    </div>
</nav>