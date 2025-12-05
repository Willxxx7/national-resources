<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // check db connection before every connection
        $middleware->append(\App\Http\Middleware\CheckDBConnectionMiddleware::class);
        // set header accept: application/json for all requests
        // no web routes will be used, so shouldn't cause any issue as it is an all api
        $middleware->append(\App\Http\Middleware\ForceJsonMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // force json render for api prefixed routes
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $throwable) {
            if ($request->is('api/*')) {
                return true;
            }
            return $request->expectsJson();
        });
        $exceptions->render(function(Throwable $throwable){
            if($throwable instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
                return response()->json([
                    'success' => false,
                    'message' => $throwable->getMessage()
                ], 405);
            }
            if($throwable instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
                return response()->json([
                   'success' => false,
                   'message' => 'Not found'
                ], 404);
            }
            if($throwable instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException){
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to access/modify this resource'
                ], 403);
            }
        });

        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            // if a user passes an invalid token, following returned
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing auth bearer token'
            ], 401);
        });
    })->create();
