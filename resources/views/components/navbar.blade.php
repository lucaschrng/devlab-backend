<nav class="sticky top-0 flex justify-between max-sm:justify-start items-center py-4 px-8 shadow-small bg-bg z-10">
    <a href="{{ url('') }}"><h1 class="text-2xl font-semibold max-sm:hidden">wikiMovies</h1></a>
    <div class="flex max-sm:justify-between max-sm:w-full items-stretch gap-4">
        <div class="flex items-stretch min-h-full rounded bg-lighter-bg max-sm:w-min">
            <input type="checkbox" name="activate-search" id="activate-search" class="peer hidden">
            <input type="text" placeholder="Search" name="search-query" id="search-query" class="w-0 p-0 border-none text-lg rounded bg-transparent focus:outline-none placeholder:text-neutral-400 transition-all peer-checked:w-60 max-sm:peer-checked:w-[200px] max-sm:peer-checked:min-w-[200px] peer-checked:pl-3 peer-checked:p-2">
            <label for="activate-search" class="search-label w-fit flex content-center items-center px-2 text-2xl bg-bg hover:bg-lighter-bg cursor-pointer rounded peer-checked:hidden">
                <ion-icon name="search-outline" class="row-overlap col-overlap opacity-40"></ion-icon>
            </label>
            <label for="activate-search" class="close-label w-fit hidden content-center items-center px-2 text-2xl cursor-pointer peer-checked:flex">
                <ion-icon name="close-outline" class="row-overlap col-overlap opacity-40"></ion-icon>
            </label>
        </div>
        <a href="{{ Auth::check() ? '/dashboard':'/login' }}" class="h-10 w-10 flex items-center rounded-full bg-lighter-bg">
            <span class="w-full h-min text-center text-xl">
                @if(Auth::check())
                    {{ Auth::user()->firstName[0] . Auth::user()->lastName[0] }}
                @else
                    <ion-icon name="log-in-outline" class="w-full flex justify-center items-center text-2xl opacity-50"></ion-icon>
                @endif
            </span>
        </a>
    </div>
</nav>
<div class="results-section hidden px-24 max-sm:px-6 animate-fade">
    <div class="w-full left-0 top-full mt-20 flex justify-between text-2xl">
        <h2 class="text-white text-opacity-50">Results for: <span class="query text-accent"></span></h2>
    </div>
    <h2 class="text-2xl text-white mt-10">Users:</h2>
    <div class="usersResults flex flex-wrap justify-between gap-6 max-w-full mt-10"></div>
    <h2 class="text-2xl text-white mt-10">Movies:</h2>
    <div class="results flex flex-wrap justify-between gap-6 max-w-full mt-10"></div>
</div>
