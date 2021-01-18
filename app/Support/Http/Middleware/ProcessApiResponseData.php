<?php

namespace Support\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use stdClass;

class ProcessApiResponseData
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ( ! $this->isJson($response)) {
            return $response;
        }

        $data = $response->getData();

        if ( ! $this->isEditableData($data)) {
            return $response;
        }

        $data = $this->appendSuccessState($response, $data);

        $response->setData($data);

        return $response;
    }

    /**
     * Append success state to response payload.
     *
     * @param mixed $response
     * @param mixed $data
     *
     * @return \stdClass
     */
    private function appendSuccessState($response, $data): stdClass
    {
        if (is_array($data)) {
            $data = (object) $data;
        }

        if (property_exists($data, 'success')) {
            return $data;
        }

        $data->success = $this->guessSuccessState($response);

        return $data;
    }

    /**
     * Determine if is a JsonResponse instance.
     *
     * @param $response
     *
     * @return bool
     */
    private function isJson($response): bool
    {
        return $response instanceof JsonResponse;
    }

    /**
     * Determine if data is editable.
     *
     * @param mixed $data
     *
     * @return bool
     */
    private function isEditableData($data): bool
    {
        return is_array($data) || $data instanceof stdClass;
    }

    /**
     * Guess response boolean state.
     * This method is provided by Symfony\Component\HttpFoundation\Response.
     *
     * @param mixed $response
     *
     * @return bool
     */
    private function guessSuccessState($response): bool
    {
        return $response->isSuccessful();
    }
}
