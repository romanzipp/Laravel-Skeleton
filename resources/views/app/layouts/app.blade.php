<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    {{ seo()->render() }}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

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

                <div class="flex">

                    @auth

                        <div class="px-2">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="px-2">

                            <form action="{{ route('auth.logout.process') }}" method="post">
                                @csrf

                                <button type="submit" class="inline hover:text-blue-500">
                                    Logout
                                </button>

                            </form>

                        </div>

                    @else

                        <a href="{{ route('auth.login.show') }}" class="px-2 hover:text-blue-500">
                            Login
                        </a>

                        <a href="{{ route('auth.register.show') }}" class="px-2 hover:text-blue-500">
                            Register
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

    <main class="container mx-auto py-4">

        @yield('content')

    </main>

</body>
</html>
