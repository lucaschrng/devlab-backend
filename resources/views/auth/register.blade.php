<x-layout>
    <!--<x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>-->
<main>
    <H2 class="text-white text-3xl text-center">Register</H2>
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4 m-center w-1/2">
            @csrf

            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" class="text-white"/>
                <x-text-input id="username" class="block mt-1 w-full text-black" type="text" name="username" :value="old('username')" required autofocus />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- First Name -->
            <div>
                <x-input-label for="firstName" :value="__('First Name')" class="text-white"/>
                <x-text-input id="firstName" class="block mt-1 w-full text-black" type="text" name="firstName" :value="old('firstName')" required autofocus />
                <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="lastName" :value="__('Last Name')" class="text-white"/>
                <x-text-input id="lastName" class="block mt-1 w-full text-black" type="text" name="lastName" :value="old('lastName')" required autofocus />
                <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-white"/>
                <x-text-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-white"/>

                <x-text-input id="password" class="block mt-1 w-full text-black"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white"/>

                <x-text-input id="password_confirmation" class="block mt-1 w-full text-black"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

</main>
   <!-- </x-auth-card>-->
</x-layout>
