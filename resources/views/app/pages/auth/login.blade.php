@extends('app.layouts.auth')

@section('content')

    <h1 class="mb-8 text-4xl font-semibold">
        {{ __('Sign in') }}
    </h1>

    <x-auth.oauth-buttons :services="$oauthServices" />

    <x-spacer>OR</x-spacer>

    <form method="post" action="{{ route('auth.login.process') }}" class="space-y-4">
        @csrf

        <x-form-field type="email"
                      name="email"
                      label="E-Mail Address"
                      autocomplete="email"
                      placeholder="john@doe.com"
                      :autofocus="true"
                      :required="true" />

        <x-form-field type="password"
                      name="password"
                      label="Password"
                      autocomplete="current-password"
                      placeholder="********" />

        @if (Route::has('auth.password.request'))

            <div class="mt-4">
                <a class="text-sm text-primary-600 dark:text-primary-500 font-medium" href="{{ route('auth.password.request') }}">
                    {{ __('Forgot password') }}
                </a>
            </div>

        @endif

        @if(config('turnstile.site_key'))
            {{ \romanzipp\Turnstile\Captcha::getChallenge() }}
        @endif

        <div>
            <button type="submit" class="button button-primary w-full">
                {{ __('Login') }}
            </button>
        </div>

    </form>

    <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400 font-medium">
        Don't have an account? <a href="{{ route('auth.register.show') }}" class="text-primary-600 dark:text-primary-500">{{ __('Sign up') }}</a>
    </div>

@endsection
