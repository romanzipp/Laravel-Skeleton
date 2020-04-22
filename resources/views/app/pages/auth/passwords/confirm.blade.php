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

        <x-form-field type="password" name="password" label="Password" autocomplete="current-password" placeholder="********" :required="true" />

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Confirm Password') }}
            </button>

        </div>

    </form>

@endsection
