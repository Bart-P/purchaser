const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'purchaser-primary': {
                    light: '#f5dfef',
                    DEFAULT: '#9B287B',
                    dark: '#421134'
                },
                'purchaser-secondary': '#F96E46',
                'purchaser-dark': '#00072D',
                'purchaser-light': '#EFEFEF'
            },
        },
    },


    plugins: [require('@tailwindcss/forms')],
};