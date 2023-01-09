const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/app.js',
        './resources/js/album.js'
    ],
    theme: {
        extend: {
            margin:{
                'center':'0 auto',
            },
            colors: {
                'bg': '#1E1E1E',
                'lighter-bg': '#383838',
                'accent': '#8D5EF6'
            },
            boxShadow: {
                'small': '0px 4px 4px rgba(0, 0, 0, 0.25)',
            },
            gridColumn: {
                'overlap': '1 / span 1',
            },
            gridRow: {
                'overlap': '1 / span 1',
            },
            animation: {
                fade: 'fade 0.5s ease',
            },
            keyframes: {
                fade: {
                    '0%': { opacity: 0},
                    '100%': { opacity: 1},
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
