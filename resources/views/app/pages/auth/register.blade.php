@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Register') }}
    </h1>

    <form method="POST" action="{{ route('auth.register.process') }}">

        @csrf

        <x-form-field type="email" name="email" label="E-Mail Address" autocomplete="email" placeholder="john@doe.com" :required="true" :autofocus="true" />

        <x-form-field type="text" name="name" label="Name" autocomplete="name" placeholder="John Doe" :required="true" />

        <x-form-field type="password" name="password" label="Password" autocomplete="new-password" placeholder="********" :required="true" />

        <x-form-field type="password" name="password_confirmation" label="Confirm Password" autocomplete="new-password" placeholder="********" :required="true" />

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Register') }}
            </button>

        </div>

    </form>


@endsection
