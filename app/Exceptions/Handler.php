<?php

namespace App\Exceptions;

use App\Models\Respuesta;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use PDOException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
       /* $this->reportable(function (ModelNotFoundException $e) {
              
            $respuesta=new Respuesta();
            $respuesta->setStatusCode(200);
            $respuesta->setError(true);
            $respuesta->setMensajeError("El registro no se ha encontrado");
            return response()->json($respuesta);
        });*/
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $respuesta=new Respuesta();
            $respuesta->setStatusCode(404);
            $respuesta->setError(true);
            $respuesta->setMensajeError("El registro no se ha encontradoa");
            return response()->json($respuesta);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $respuesta=new Respuesta();
            $respuesta->setStatusCode(405);
            $respuesta->setError(true);
            $respuesta->setMensajeError("Esa llamada no esta permitida");
            return response()->json([$respuesta], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof PDOException) {
            $respuesta=new Respuesta();
            $respuesta->setStatusCode(500);
            $respuesta->setError(true);
            $respuesta->setMensajeError("Error al conectar con la bbdd");
            return response()->json([$respuesta], Response::HTTP_NOT_FOUND);
        }
        //NotFoundHttpException 
        
        return parent::render($request, $exception);
    }
}
