<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;

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
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function renderHttpException(HttpException $e)
    {
        $status = $e->getStatusCode();

        if (Request::ajax() || Request::wantsJson()) {
            return response()->json([], $status);
        } else if (Request::is('admin*') || Request::is('backend*')) {
            return response()->view("backend.errors.{$status}", ['exception' => $e], $status, $e->getHeaders());
        } else {
            return parent::renderHttpException($e);
//            return response()->view("frontend.errors.{$status}", ['exception' => $e], $status, $e->getHeaders());
        }
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            response()->json(['message' => $exception->getMessage()], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'travel_agent':
                $login = 'travel_agent.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));

    }


}
