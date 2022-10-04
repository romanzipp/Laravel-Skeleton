@extends('app.layouts.auth')

@section('content')

    <h1 class="mb-8 text-3xl">
        {{ __('Verify Your Email Address') }}
    </h1>

    @if (session('resent'))

        <div class="my-4 p-4 bg-green-200 text-green-800 rounded">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>

    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},

    <form class="inline" method="post" action="{{ route('auth.verification.resend') }}">
        @csrf

        <button type="submit" class="inline">{{ __('click here to request another') }}</button>

    </form>

@endsection
