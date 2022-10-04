<?php

namespace Domain\Auth\Http\Controllers\Login;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use romanzipp\Turnstile\Rules\TurnstileCaptcha;
use Support\Http\Controllers\AbstractController;

final class ProcessLoginController extends AbstractController
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return $this->login($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'string'],
            'password' => ['required', 'string'],
            'cf-turnstile-response' => ['required', 'string', new TurnstileCaptcha()],
        ]);
    }
}
