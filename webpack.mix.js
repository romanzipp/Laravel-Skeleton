const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js');

mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });

mix.copyDirectory('node_modules/@fontsource/inter/files', 'public/css/files');
