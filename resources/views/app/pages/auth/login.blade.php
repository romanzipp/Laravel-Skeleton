@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Login') }}
    </h1>

    <form method="post" action="{{ route('auth.login.process') }}">
        @csrf

        <div class="my-4 field">

            <label for="email">
                {{ __('E-Mail Address') }}
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email"
                   autofocus
                   placeholder="E-Mail"
                   class="input @if($errors->has('email')) input-error @endif">

            @if($errors->has('email'))
                {{ $errors->first('email') }}
            @endif

        </div>

        <div class="my-4 field">

            <label for="password">
                {{ __('Password') }}
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="Password"
                   class="input @if($errors->has('password')) input-error @endif">

            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif

        </div>

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
