let mix = require('laravel-mix');
require('mix-tailwindcss');

mix
    .sass('resources/scss/main.scss', 'public/css/style.css')
    .tailwind();