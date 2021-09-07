<?php

namespace Domain\Auth\Http\Controllers\Password\Reset;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ProcessSendResetEmailController extends AbstractController
{
    use SendsPasswordResetEmails;

    public function __invoke(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
}
