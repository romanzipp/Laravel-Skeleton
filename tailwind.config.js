const form = require('./resources/js/tailwind/form');
const button = require('./resources/js/tailwind/button');

module.exports = {
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
