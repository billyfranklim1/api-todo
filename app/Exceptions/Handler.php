<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // /**
    //  * Register the exception handling callbacks for the application.
    //  */
    // public function register(): void
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }

    public function register(): void
    {
        if (request()?->is('api/*')) {
            $this->renderable(function (ModelNotFoundException $exception, Request $request) {
                return response()->json([
                    'message' => $exception->getMessage()
                ], Response::HTTP_NOT_FOUND);
            });

            $this->renderable(function (NotFoundHttpException $exception, Request $request) {
                $message = !empty($exception->getMessage())
                    ? $exception->getMessage()
                    : __('error.route_not_found');

                return response()->json([
                    'message' => $message
                ], Response::HTTP_NOT_FOUND);
            });

            $this->renderable(function (AuthenticationException $exception, Request $request) {
                return response()->json([
                    'message' => __('auth.unauthenticated')
                ], Response::HTTP_UNAUTHORIZED);
            });

            $this->renderable(function (Throwable $exception, Request $request) {
                if (app()->bound('sentry') && !app()->isLocal()) {
                    app('sentry')->captureException($exception);
                }

                $status = method_exists($exception, 'getStatusCode')
                    ? $exception->getStatusCode()
                    : Response::HTTP_BAD_REQUEST;

                return response()->json([
                    'message' => $exception->getMessage()
                ], $status);
            });
        }
    }

}
