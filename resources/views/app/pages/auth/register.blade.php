@extends('app.layouts.app')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Register') }}
    </h1>

    <form method="POST" action="{{ route('auth.register.process') }}">

        @csrf

        <div class="field my-4">

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
                   placeholder="Name"
                   class="input @if($errors->has('name')) input-error @endif">

            @if($errors->has('name'))
                {{ $errors->first('name') }}
            @endif

        </div>

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
                   placeholder="E-Mail"
                   class="input @if($errors->has('email')) input-error @endif">

            @if($errors->has('email'))
                {{ $errors->first('email') }}
            @endif

        </div>

        <div class="field my-4">

            <label for="password">
                {{ __('Password') }}
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
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
                   placeholder="Confirm Password"
                   class="input">

        </div>

        <div class="my-4">

            <button type="submit" class="button button-blue">
                {{ __('Register') }}
            </button>

        </div>

    </form>


@endsection
