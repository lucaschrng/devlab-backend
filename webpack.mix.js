let mix = require('laravel-mix');
require('mix-tailwindcss');

mix.js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/genre.js', 'public/js/genre.js')
    .sass('resources/scss/main.scss', 'public/css/style.css')
    .tailwind();
