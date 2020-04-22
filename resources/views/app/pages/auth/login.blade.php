@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Login') }}
    </h1>

    <form method="post" action="{{ route('auth.login.process') }}">
        @csrf

        <x-form-field type="email" name="email" label="E-Mail Address" autocomplete="email" placeholder="john@doe.com" :required="true" />

        <x-form-field type="password" name="password" label="Password" autocomplete="current-password" placeholder="********" />

        <div class="field checkbox-field my-4">

            <input type="checkbox"
                   name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label for="remember">
                {{ __('Remember Me') }}
            </label>

        </div>

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Login') }}
            </button>

            @if (Route::has('auth.password.request'))

                <a class="button button-blue button-secondary" href="{{ route('auth.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>

            @endif

        </div>

    </form>

@endsection
