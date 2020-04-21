<?php

namespace Domain\User\Http\Controllers\Auth\Password\Reset;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ShowSendResetEmailController extends AbstractController
{
    use SendsPasswordResetEmails;

    public function __invoke(Request $request)
    {
        return view('app.pages.auth.passwords.email');
    }
}
