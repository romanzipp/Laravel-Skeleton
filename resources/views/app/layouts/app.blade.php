<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ manifest('js/app.js') }}" defer></script>
    <link href="{{ manifest('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="mb-6 bg-white shadow-md">

        <div class="container mx-auto">

            <div class="flex items-center justify-between">

                <div class="py-2 text-xl">

                    <a href="{{ route('index') }}">
                        {{ config('app.name') }}
                    </a>

                </div>

                <div>

                    <a href="{{ route('auth.login.show') }}" class="px-2 hover:text-blue-500">
                        Login
                    </a>

                    <a href="{{ route('auth.register.show') }}" class="px-2 hover:text-blue-500">
                        Register
                    </a>

                </div>

            </div>

        </div>

    </div>

    <main class="container mx-auto py-4">
        @yield('content')
    </main>

</body>
</html>
