<?php

namespace Support\Http\Controllers;

final class SpaController
{
    public function __invoke()
    {
        return view('app.layouts.app-spa');
    }
}
