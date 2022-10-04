<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    {{ seo()->render() }}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ manifest('js/app.js') }}" defer></script>
    <link href="{{ manifest('css/app.css') }}" rel="stylesheet">

    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFFFFF' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>

</head>
<body class="frame">

    <div class="frame-inner">

        <div class="frame-left">

            @if(session()->has('oauth_error'))
                <div class="mb-4 bg-red-100 border border-red-200 rounded-md shadow shadow-red-50 text-sm text-red-700 p-2 leading-normal">
                    {{ session()->get('oauth_error') }}
                </div>
            @endif

            <main>
                @yield('content')
            </main>
        </div>

        <div class="frame-right">

            <div class="relative z-20 flex items-center justify-center w-full h-full">

                <div class="space-y-8">
                    <div class="text-center text-3xl sm:text-4xl md:text-5xl xl:text-7xl font-semibold">
                        {{ config('app.name') }}
                    </div>

                    <p class="hidden lg:block leading-normal text-white text-opacity-80">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        <br>
                        Morbi posuere nunc eu pretium sodales.
                    </p>
                </div>

            </div>

            <div class="frame-pattern frame-pattern-1"></div>
            <div class="frame-pattern frame-pattern-2"></div>

        </div>

    </div>

</body>
</html>
