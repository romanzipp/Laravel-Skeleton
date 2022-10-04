const colors = require('tailwindcss/colors');
const forms = require('@tailwindcss/forms');
const typography = require('@tailwindcss/typography');
const button = require('./resources/js/tailwind/button');

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: colors.blue,
            },
        },
    },
    variants: {},
    plugins: [
        forms({
            strategy: 'class',
        }),
        button,
        typography,
    ],
};
