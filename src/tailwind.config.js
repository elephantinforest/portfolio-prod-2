/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./src/views/*', './src/views/*/*', './js/*.{js,ts,jsx,tsx}'],
    theme: {
        extend: {},
    },
    plugins: [require('tailwindcss-animated')],
}
