const form = require('./resources/js/tailwind/form');
const button = require('./resources/js/tailwind/button');

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: { },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/typography'),
        form,
        button,
    ],
};
