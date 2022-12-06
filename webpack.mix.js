let mix = require('laravel-mix');
require('mix-tailwindcss');

mix.js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/album.js', 'public/js/album.js')
    .sass('resources/scss/main.scss', 'public/css/style.css')
    .tailwind();
