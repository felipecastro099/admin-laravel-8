<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            if (app()->environment() == 'production' && $this->shouldReport($e) && app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if (app()->environment() == 'production'):
            if ($exception instanceof ModelNotFoundException or $exception instanceof NotFoundHttpException):
                if ($request->ajax() || $request->wantsJson()):
                    return response()->json(['error' => 'Página não encontrada.'], 404);
                endif;

                if ($request->is('admin/*')):
                    return response()->view('admin.errors.404', [], 404);
                else:
                    return response()->view('front.errors.404', [], 404);
                endif;
            endif;

            if ($exception instanceof UnauthorizedException):
                if ($request->ajax() || $request->wantsJson()):
                    return response()->json(['error' => 'Acesso negado.'], 404);
                endif;

                if ($request->is('admin/*')):
                    return response()->view('admin.errors.403', [], 403);
                else:
                    return response()->view('front.errors.403', [], 403);
                endif;
            endif;

            if ($exception instanceof \ErrorException):
                if ($request->is('admin/*')):
                    return response()->view('admin.errors.500', [], 500);
                else:
                    return response()->view('front.errors.500', [], 500);
                endif;
            endif;
        endif;

        return parent::render($request, $exception);
    }
}
