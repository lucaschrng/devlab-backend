<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>

<body>
    <header class="sticky top-0 z-20">
        <x-navbar />
    </header>
    <main class="py-24 flex flex-col gap-24">
        <x-movieCarousel title="Popular movies" :movies="$popularMovies"/>
        <x-movieCarousel title="Trending movies" :movies="$trendingMovies"/>
    </main>
    <script src="/js/app.js"></script>
</body>

</html>
