/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/*.php',
    './resources/views/components/*.php',
    './resources/js/*.js'
  ],
  theme: {
    extend: {
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
  plugins: [],
}
