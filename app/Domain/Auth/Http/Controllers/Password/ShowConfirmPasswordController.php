<?php

namespace Domain\Auth\Http\Controllers\Password;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ShowConfirmPasswordController extends AbstractController
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return view('app.pages.auth.passwords.confirm');
    }
}
