@extends('app.layouts.auth')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Reset Password') }}
    </h1>

    <form method="post" action="{{ route('auth.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <x-form-field type="email" name="email" label="E-Mail Address" autocomplete="email" :value="$email ?? old('email')" :required="true" />

        <x-form-field type="password" name="password" label="Password" autocomplete="new-password" placeholder="********" :required="true" />

        <x-form-field type="password" name="password_confirmation" label="Confirm Password" autocomplete="new-password" placeholder="********" :required="true" />

        <div class="my-4">

            <button type="submit" class="button button-primary">
                {{ __('Reset Password') }}
            </button>

        </div>

    </form>

@endsection
