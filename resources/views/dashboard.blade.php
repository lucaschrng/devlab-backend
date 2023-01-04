<x-layout>
    <main class="p-[96px]">
        <div class="flex items-center gap-6">
            <h2 class="text-4xl font-medium">Hi, {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} !</h2>
            <ion-icon name="mail" class="text-3xl opacity-50 hover:opacity-100 hover:cursor-pointer"></ion-icon>
        </div>
        <h3 class="text-xl text-white/60">{{ '@' . Auth::user()->username }}</h3>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button class="mt-4 flex gap-2 items-center text-xl opacity-50 bg-lighter-bg p-2 rounded hover:opacity-100">Log Out<ion-icon name="log-out-outline" class="text-3xl"></ion-icon></button>
        </form>
        <div class="mt-24">
            <h2 class="text-3xl font-medium">Your albums:</h2>
            <div>

            </div>
        </div>
    </main>
</x-layout>
