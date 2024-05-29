<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        // Saat terjadi exception, kadang-kadang kita ingin melaporkan error tersebut, contoh misal ke Telegram, Slack atau Sentry
        $this->reportable(function (Throwable $e) {
            //var_dump($e);
            return false;
        });

        $this->renderable(function (ValidationException $exception, Request $request){
            return response("Bad Request", 400);
        }); // renderable // akan keluar jenis exception yang kita buat seperti ValidationException, pesana error langusng dari response(error_message, status_code)
    }
}
