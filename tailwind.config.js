const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors: {
            primary: '#1470c4',
            secondary: '#ddeffe',
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            green: colors.emerald,
            brand: colors.brand,
            yellow: colors.amber,
            red: colors.red,
            blue: colors.blue,
            purple: colors.violet,
            pink: colors.pink,
            brand: {
                0: '#f5f7f8',
                50: '#eaf1f9',
                100: '#A1C6E7',
                200: '#72A9DC',
                300: '#438DD0',
                400: '#1470C4',
                500: '#105A9D',
                600: '#0C4376',
                700: '#082D4E',
                800: '#041627',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
