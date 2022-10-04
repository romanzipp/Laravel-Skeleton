@extends('app.layouts.auth')

@section('content')

    <h1 class="mb-8 text-4xl font-semibold">
        {{ __('Sign up') }}
    </h1>

    <x-auth.oauth-buttons :services="$oauthServices" />

    <x-spacer>OR</x-spacer>

    <form method="POST" action="{{ route('auth.register.process') }}" class="space-y-4">

        @csrf

        <x-form-field type="email"
                      name="email"
                      label="E-Mail Address"
                      autocomplete="email"
                      placeholder="john@doe.com"
                      :required="true"
                      :autofocus="true" />

        <x-form-field type="text"
                      name="name"
                      label="Name"
                      autocomplete="name"
                      placeholder="John Doe"
                      :required="true" />

        <x-form-field type="password"
                      name="password"
                      label="Password"
                      autocomplete="new-password"
                      placeholder="********"
                      :required="true" />

        <x-form-field type="password"
                      name="password_confirmation"
                      label="Confirm Password"
                      autocomplete="new-password"
                      placeholder="********"
                      :required="true" />

        @if(config('turnstile.site_key'))
            {{ \romanzipp\Turnstile\Captcha::getChallenge() }}
        @endif

        <div class="my-4">

            <button type="submit" class="button button-primary w-full">
                {{ __('Sign up') }}
            </button>

        </div>

    </form>

    <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400 font-medium">
        Already have an account? <a href="{{ route('auth.login.show') }}" class="text-primary-600 dark:text-primary-500">{{ __('Sign in') }}</a>
    </div>

@endsection
