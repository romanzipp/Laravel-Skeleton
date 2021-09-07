<?php

namespace Domain\Auth\Http\Controllers\Verification;

use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ShowVerificationController extends AbstractController
{
    use VerifiesEmails;

    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        return view('app.pages.auth.verify');
    }
}
