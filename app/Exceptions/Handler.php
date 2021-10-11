<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use PDOException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
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
        // $exception = $this->prepareException($exception);

        $status = 0;
        $code = 404;
        $message = '';
        $class = '';
        $message = '';

        if ($request->expectsJson()) {

            if ($exception instanceof ValidationException) {

                $code = $exception->status;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Validasi Gagal';
                $data = $exception->validator->errors()->getMessages();
            }
            elseif ($exception instanceof QueryException) {
                
                $code = $exception->getCode();
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Query database Error';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof PDOException) {
                
                $code = $exception->getCode();
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Processing Database Error';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof AuthenticationException) {
                
                $code = 401;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Autorisasi Gagal';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof NotFoundHttpException) {
                
                $code = 404;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Url Not Found';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof MethodNotAllowedHttpException) {
                
                $code = 405;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'HTTP method is not allowed';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof NotAcceptableHttpException) {
                
                $code = 406;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'HTTP Accept header is not allowed';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof ModelNotFoundException) {
                
                $code = 422;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Model Not Found';
                $data = $exception->getMessage();
                
            }
            elseif ($exception instanceof MethodNotAllowedHttpException) {
                
                $code = 405;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Method Not Allow';
                $data = $exception->getMessage();
            }
            else{

                $code = $exception->getCode() ?? 404;
                $class = (new \ReflectionClass($exception))->getShortName();
                $message = 'Unknow Exeption';
                $data = $exception->getMessage();
            }
            
            $return = [
                "status" => false,
                "code" => $code,
                "name" => $class,
                "message" => $message,
                "data" => $data,
            ];

            if (config('app.debug')) {
                $return['trace'] = $exception->getTrace();
            }

            return response()->json($return, 200);

        }

        return parent::render($request, $exception);
    }
}
