<?php

namespace Domain\Auth\Http\Controllers\Password\Reset;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use romanzipp\Turnstile\Rules\TurnstileCaptcha;

final class ProcessResetPasswordController
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return $this->reset($request);
    }

    protected function rules()
    {
        return [
            'token' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
            'cf-turnstile-response' => config('turnstile.site_key') ? [
                'required',
                'string',
                new TurnstileCaptcha(),
            ] : [],
        ];
    }
}
