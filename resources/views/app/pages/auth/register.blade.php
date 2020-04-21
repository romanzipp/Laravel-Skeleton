@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Register') }}
    </h1>

    <form method="POST" action="{{ route('auth.register.process') }}">

        @csrf

        <div class="my-4">

            <label for="name">
                {{ __('Name') }}
            </label>

            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autocomplete="name"
                   autofocus
                   class="@if($errors->has('name')) bg-red-500 @else bg-gray-200 @endif">

            @if($errors->has('name'))
                {{ $errors->first('name') }}
            @endif

        </div>

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
                   class="@if($errors->has('password')) bg-red-500 @else bg-gray-200 @endif">

            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif

        </div>

        <div class="my-4">

            <label for="password_confirmation">
                {{ __('Confirm Password') }}
            </label>

            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   class="bg-gray-200">

        </div>

        <div class="my-4">

            <button type="submit">
                {{ __('Register') }}
            </button>

        </div>

    </form>


@endsection
