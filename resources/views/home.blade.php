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
    <header class="sticky top-0 z-10">
        <x-navbar />
    </header>
    <main class="py-24">
        <h2 class="px-24 text-3xl font-medium">Best movies of all time</h2>
        <div class="best-movies-container grid items-center">
            <ion-icon name="chevron-back-outline" class="previous-button ml-6 p-3 text-3xl rounded-full col-overlap row-overlap cursor-pointer bg-black/70 backdrop-blur z-10"></ion-icon>
            <ion-icon name="chevron-forward-outline" class="next-button mr-6 p-3 text-3xl rounded-full col-overlap row-overlap cursor-pointer bg-black/70 backdrop-blur justify-self-end z-10"></ion-icon>
            <div class="best-movies px-24 flex max-w-full overflow-hidden gap-6 col-overlap row-overlap"></div>
        </div>
    </main>
    <script src="/js/app.js"></script>
</body>

</html>