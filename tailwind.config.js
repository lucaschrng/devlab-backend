/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/*.php',
    './resources/views/components/*.php'
  ],
  theme: {
    extend: {
      colors: {
        'bg': '#1E1E1E',
        'lighter-bg': '#383838',
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
    },
  },
  plugins: [],
}
