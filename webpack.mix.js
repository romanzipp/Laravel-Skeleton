const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js');

mix.sass('resources/sass/app.scss', 'public/css')
   .options({
       processCssUrls: false,
       postCss: [tailwindcss('./tailwind.config.js')],
   });
