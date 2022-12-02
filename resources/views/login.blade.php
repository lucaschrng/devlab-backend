<?php
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
    <form action="{{ route('user.connect'}}" method="post" name="login" class=" flex flex-col gap-4">
        <input type="text" placeholder="email" name="email">
        <input type="password" placeholder="Your password" name="password">
        <input type="submit" value="Envoyer">
    </form>
</main>


<script src="/js/app.js"></script>
</body>
</html>
