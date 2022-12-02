<?php
use Illuminate\Support\Facades\Http;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title>wikiMovies</title>
</head>
<body>
<header>
    <x-navbar/>
</header>

<main>
    <form class="flex flex-col gap-4 text-white" method="post" action="{{ route('user.store') }}">
        @csrf
        <label for="username">Username</label>
        <input type="text" placeholder="username" name="username">
        @error("username")
        <p class="text-error">{{$message}}</p>
        @enderror

        <label for="firstName">First Name</label>
        <input type="text" placeholder="Your First Name" name="firstName">

        @error("firstName")
        <p class="text-xl text-error ">{{$message}}</p>
        @enderror

        <label for="lastName">Last Name</label>
        <input type="text" placeholder="Your Last Name" name="lastName" >
        @error('lastName')
        <p class="text-error ">{{ $message }}</p>
        @enderror

        <label for="email">Email</label>
        <input type="email" placeholder="Your E-mail" name="email">

        @error("email")
        <p class="text-error">{{$message}}</p>
        @enderror

        <label for="username">Password</label>
        <input type="password" placeholder="password" name="password">

        @error("password")
        <p class="text-error">{{$message}}</p>
        @enderror

        <input type="submit" value="Envoyer">
    </form>


</main>

<script src="/js/app.js"></script>
</body>
</html>
<?php


