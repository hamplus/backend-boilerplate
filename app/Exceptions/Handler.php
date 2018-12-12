<?php

namespace App\Exceptions;

use App\Hamsaa\Constants\SystemResponses;
use App\Hamsaa\Exceptions\BaseException;
use App\Hamsaa\Exceptions\SystemExceptions\BaseSystemException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as IlluminateResponse;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception): void
    {
        if ($exception instanceof BaseSystemException) {
            Log::critical($exception->getTitle(), $exception->getTrace());
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof BaseSystemException) {
            return response()->json([
                'message' => 'Something went wrong on our side'
            ], $exception->getStatusCode());
        }

        if ($exception instanceof BaseException) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getStatusCode());
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => SystemResponses::RESOURCE_NOT_FOUND,
            ], IlluminateResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'message' => SystemResponses::USER_NOT_AUTHORIZED,
            ], IlluminateResponse::HTTP_FORBIDDEN);
        }

        return parent::render($request, $exception);
    }
}
