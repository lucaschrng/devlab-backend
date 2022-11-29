/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/*.php',
    './resources/views/components/*.php'
  ],
  theme: {
    extend: {
      colors: {
        'lighter-bg': '#383838',
      },
      boxShadow: {
        'small': '0px 4px 4px rgba(0, 0, 0, 0.25)',
      },
    },
  },
  plugins: [],
}
