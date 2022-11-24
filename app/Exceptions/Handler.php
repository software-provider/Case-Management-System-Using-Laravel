<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
    * Render an exception into an HTTP response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Exception  $e
    * @return \Illuminate\Http\Response
    */
    public function render($request, Throwable $e)
    {
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        }

        return parent::render($request, $e);
    }
}
