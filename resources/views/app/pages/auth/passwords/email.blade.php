@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Reset Password') }}
    </h1>

    <form method="post" action="{{ route('auth.password.email') }}">
        @csrf

        <x-form-field type="email" name="email" label="E-Mail Address" autocomplete="email" placeholder="john@doe.com" :required="true" />

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Send Password Reset Link') }}
            </button>

        </div>

    </form>

@endsection
