const form = require('./resources/js/tailwind/form');
const button = require('./resources/js/tailwind/button');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                display: [
                    'Montserrat',
                    'sans-serif'
                ]
            }
        }
    },
    variants: {},
    plugins: [
        form,
        button
    ]
};
