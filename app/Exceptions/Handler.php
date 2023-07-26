<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthorizationException $exception) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (JWTException $exception) {
            return response()->json([
                'message' => 'Invalid token'
            ], Response::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (NotFoundHttpException $exception) {
            return response()->json([
                'message' => 'The requested resource was not found on this route.'
            ], Response::HTTP_NOT_FOUND);
        });

        $this->renderable(function (QueryException $exception) {
            return response()->json([
                'message' => 'An error occurred. Please try again.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });

        $this->renderable(function (ErrorException $exception) {
            return response()->json([
                'message' => 'An error occurred. Please try again.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
