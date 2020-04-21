@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Login') }}
    </h1>

    <form method="post" action="{{ route('auth.login.process') }}">
        @csrf

        <div class="my-4">

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
                   class="@if($errors->has('email')) bg-red-500 @else bg-gray-200 @endif">

            @if($errors->has('email'))
                {{ $errors->first('email') }}
            @endif

        </div>

        <div class="my-4">

            <label for="password">
                {{ __('Password') }}
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   class="@if($errors->has('password')) bg-red-500 @else bg-gray-200 @endif">

            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif

        </div>

        <div class="my-4">

            <input type="checkbox"
                   name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label for="remember">
                {{ __('Remember Me') }}
            </label>

        </div>

        <div class="my-4">

            <button type="submit">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>

    </form>

@endsection
