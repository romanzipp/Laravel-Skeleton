@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Reset Password') }}
    </h1>

    <form method="post" action="{{ route('auth.password.email') }}">
        @csrf

        <div class="field my-4">

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
                   placeholder="E-Mail Address"
                   class="input @if($errors->has('email')) input-error @endif">

            @if($errors->has('email'))
                {{ $errors->first('email') }}
            @endif

        </div>

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Send Password Reset Link') }}
            </button>

        </div>

    </form>

@endsection
