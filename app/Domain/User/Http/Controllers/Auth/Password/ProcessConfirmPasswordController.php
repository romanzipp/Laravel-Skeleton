<?php

namespace Domain\User\Http\Controllers\Auth\Password;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;

final class ProcessConfirmPasswordController
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return $this->confirm($request);
    }
}
