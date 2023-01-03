<x-layout>
    <main class="p-[96px]">
        <h2 class="text-4xl font-medium">{{ $user->firstName }} {{ $user->lastName }}</h2>
        <h3 class="text-xl text-white/60">{{ '@' . $user->username }}</h3>
    </main>
</x-layout>
