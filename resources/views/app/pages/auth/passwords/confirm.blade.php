@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Confirm Password') }}
    </h1>

    <p>
        {{ __('Please confirm your password before continuing.') }}
    </p>

    <form method="post" action="{{ route('auth.password.update') }}">
        @csrf

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

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Confirm Password') }}
            </button>

        </div>

    </form>

@endsection
