@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Reset Password') }}
    </h1>

    <form method="post" action="{{ route('auth.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="my-4 field">

            <label for="email">
                {{ __('E-Mail Address') }}
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ $email ?? old('email') }}"
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
                   autocomplete="new-password"
                   placeholder="Password"
                   class="input @if($errors->has('password')) input-error @endif">

            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif

        </div>

        <div class="field my-4">

            <label for="password_confirmation">
                {{ __('Confirm Password') }}
            </label>

            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   placeholder="Confirm Password"
                   class="input">

        </div>

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Reset Password') }}
            </button>

        </div>

    </form>

@endsection
