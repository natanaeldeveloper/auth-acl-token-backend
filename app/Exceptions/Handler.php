<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * A list of the internal exception types that should not be reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $internalDontReport = [
        // AuthenticationException::class,
        // AuthorizationException::class,
        BackedEnumCaseNotFoundException::class,
        // HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        MultipleRecordsFoundException::class,
        RecordsNotFoundException::class,
        SuspiciousOperationException::class,
        TokenMismatchException::class,
        // ValidationException::class,
    ];

    /**
     * @var array<string<string, int>>
     */
    protected $errorMappings = [
        ValidationException::class => ['validation_error', Response::HTTP_UNPROCESSABLE_ENTITY],
        NotFoundHttpException::class => ['not_found_error', Response::HTTP_NOT_FOUND],
        AuthorizationException::class => ['authorization_error', Response::HTTP_FORBIDDEN],
        AuthenticationException::class => ['authentication_error', Response::HTTP_UNAUTHORIZED],
        MethodNotAllowedHttpException::class => ['method_not_allowed_error', Response::HTTP_METHOD_NOT_ALLOWED]
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

            $errorType  = get_class($e);
            $errorAlias = $this->errorMappings[$errorType][0] ?? 'generic_error';
            $statusCode = $this->errorMappings[$errorType][1] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
            $time       = Carbon::now();

            if ($e instanceof ValidationException) {

                $message = 'Erro de validação';
            } else if ($e instanceof NotFoundHttpException) {

                $message = 'Recurso não encontrado';
            } else if ($e instanceof AuthenticationException) {

                $message = 'Acesso não autorizado';
            } else if ($e instanceof AuthorizationException) {

                $message = 'Permissão negada';
            } else if ($e instanceof MethodNotAllowedHttpException) {

                $message = 'Método HTTP não permitido';
            } else if($e instanceof HttpException) {

                $message = 'Erro interno do servidor';
            }

            $response = response()->json([
                'message'       => $message,
                'errorAlias'    => $errorAlias,
                'code'          => $statusCode,
                'time'          => $time,
            ], $statusCode);


            // adiciona parâmetros em ambiente de desenvolvimento
            if (!app()->isProduction() && $e instanceof HttpException) {

                $data = $response->getData();

                $data->message  = $e->getMessage();
                $data->trace    = $e->getTrace();
                $data->code     = $e->getStatusCode();

                $response->setStatusCode($e->getStatusCode());
                $response->setData($data);
            }

            return $response;
        });
    }
}
