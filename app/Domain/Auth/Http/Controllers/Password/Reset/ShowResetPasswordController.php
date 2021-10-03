<?php

namespace Domain\Auth\Http\Controllers\Password\Reset;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ShowResetPasswordController extends AbstractController
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request, $token)
    {
        return view('app.pages.auth.passwords.reset', [
            'token' => $token,
            'email' => $request->input('email'),
        ]);
    }
}
