<nav class="sticky top-0 flex justify-between items-center py-4 px-8 shadow-small bg-bg z-50">
    <h1 class="text-2xl font-semibold">wikiMovies</h1>
    <div class="flex items-stretch gap-4">
        <div class="flex items-stretch min-h-full rounded bg-lighter-bg">
            <input type="checkbox" name="activate-search" id="activate-search" class="peer hidden">
            <input type="text" placeholder="Search" name="search-query" id="search-query" class="w-0 p-0 border-none text-lg rounded bg-transparent focus:outline-none placeholder:text-neutral-400 transition-all peer-checked:w-60 peer-checked:pl-3 peer-checked:p-2">
            <label for="activate-search" class="search-label w-fit flex content-center items-center px-2 text-2xl bg-bg hover:bg-lighter-bg cursor-pointer rounded peer-checked:hidden">
                <ion-icon name="search-outline" class="row-overlap col-overlap opacity-40"></ion-icon>
            </label>
            <label for="activate-search" class="close-label w-fit hidden content-center items-center px-2 text-2xl cursor-pointer peer-checked:flex">
                <ion-icon name="close-outline" class="row-overlap col-overlap opacity-40"></ion-icon>
            </label>
        </div>
        <a href="{{ Auth::check() ? '/dashboard':'/login' }}" class="h-10 w-10 flex items-center rounded-full bg-lighter-bg">
            <span class="w-full h-min text-center text-xl">L</span>
        </a>
    </div>
</nav>
<div class="results-section hidden px-24 animate-fade">
    <div class="w-full left-0 top-full mt-20">
        <div class="flex justify-between text-2xl">
            <h2 class="text-white text-opacity-50">Results for: <span class="query text-accent"></span></h2>
            <div class="flex gap-6">
                <p class="text-white text-opacity-50">
                    Filter:
                    <select name="pets" id="pet-select" class="bg-transparent cursor-pointer text-accent [&>*]:bg-bg [&>*]:text-white">
                        <option value="">none</option>
                    </select>
                </p>
                <p class="text-white text-opacity-50">
                    Sort by:
                    <select name="pets" id="pet-select" class="select-sort bg-transparent cursor-pointer text-accent [&>*]:bg-bg [&>*]:text-white">
                        <option value="none">none</option>
                        <option value="name">name</option>
                        <option value="rating">rating</option>
                        <option value="popularity">popularity</option>
                    </select>
                </p>
            </div>
        </div>
    </div>
    <div class="results flex flex-wrap justify-between gap-6 max-w-full mt-10"></div>
</div>
