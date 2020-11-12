<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ApiResponser;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\NotFoundHttpException;
use Illuminate\Database\Eloquent\MethodNotAllowedException;
use Symfony\Component\HttpKernel\Exception\HttpException;


use Throwable;
 


class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
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
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    //protected $dontFlash = [
        //'password',
        //'password_confirmation',
    //];
 /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    //public function report(Exception  $exception)
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    //public function render($request, Exception  $exception)

     public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

            

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));

            return $this ->errorResponse("Does not exists any {$modelName} with the specified identificator", 404);
        }
            




            if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        
    



        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(), 403);
        }
        


        if ($exception instanceof MethodNotAlloweddHttpException) {
            return $this->errorResponse('The specified method for the request is invalid', 405);
        }



        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('The specified URL cannot be found', 404);
        }



        if ($exception instanceof HttpException) {
         return $this->errorResponse($exception->getMessage(),$exception->getStatusCode());
        }
        


        if ($exception instanceof QueryException) {
            $errorCode = $exception->errorInfo[1];

            if ($errorCode == 1451) {
             return $this->errorResponse('cannot remove this resource permanently.It is related with any other resource', 409);
            }
        }
            
    




        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

       return $this->errorResponse('unexpected Exception. Try later', 500);
   }




       protected function unauthenticated($request, AuthenticationException $exception)
       {
       return $this->errorResponse('Unauthenticated.', 401);
       }  




       protected function convertValidationExceptionToResponse(ValidationException $e, $request) {
       
       $errors = $e->validator->errors()->getMessages();

       return $this->errorResponse($errors, 422);
       }  

       }
