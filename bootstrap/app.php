<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        then: function () {
            Route::middleware(['api','guest'])
                ->prefix('api/auth')
                ->group(base_path('routes/API/auth.php'));

            Route::middleware(['api','auth:sanctum',RoleMiddleware::class.':user'])
                ->prefix('api/user')
                ->group(base_path('routes/API/user.php'));


            Route::middleware(['api','auth:sanctum',RoleMiddleware::class.':event_planner'])
            ->prefix('api/event_planner')
            ->group(base_path('routes/API/event_planner.php'));

            Route::middleware(['api','auth:sanctum',RoleMiddleware::class.':speaker'])
            ->prefix('api/speaker')
            ->group(base_path('routes/API/speaker.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AccessDeniedHttpException $e,$request) {
            if ($request->wantsJson())
            {
                return response()->json(['status_code' => 403 , 'message' => 'Access Denied'], 403);
            }
        });
        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->wantsJson())
            {
            return response()->json(['status_code' => 405 , 'message' => 'Method Not Allowed'], 405);
            }
        });
        $exceptions->render(function (NotFoundHttpException $e,$request) {
            if ($request->wantsJson())
            {
            return response()->json(['status_code' => 404 , 'message' => 'Not Found'], 404);
            }
        });
        $exceptions->render(function (HttpException $e,$request) {
            if ($request->wantsJson())
            {
            return response()->json(['status_code' => 403 , 'message' => $e->getMessage()], 403);
            }
        });
    })->create();
