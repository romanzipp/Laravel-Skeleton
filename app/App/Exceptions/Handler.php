<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ( ! $this->isApiCall($request)) {
            return parent::render($request, $exception);
        }

        $exception = $this->prepareException($exception);

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        }

        return $this->prepareJsonResponse($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson() || $this->isApiCall($request)
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    /**
     * Determines if request is an api call.
     *
     * @param Request $request
     * @return boolean
     */
    protected function isApiCall(Request $request): bool
    {
        return $request->is('api') || $request->is('api/*');
    }
}
