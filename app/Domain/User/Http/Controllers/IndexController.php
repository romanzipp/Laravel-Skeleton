<?php

namespace Domain\User\Http\Controllers;

use Support\Http\Controllers\AbstractController;

final class IndexController extends AbstractController
{
    public function __invoke()
    {
        return view('home');
    }
}
