<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    {{ seo()->render() }}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @vite('resources/css/app.css')

</head>
<body>

    <main id="app"></main>

</body>
</html>
