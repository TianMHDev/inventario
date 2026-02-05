<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Configuramos el middleware para las peticiones de la API.
        $middleware->api(append: [
            \Illuminate\Http\Middleware\HandleCors::class, // Habilitar CORS para que otros dominios puedan consultar la API
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // FORZAR RESPUESTAS JSON:
        // Si la petición viene para la API (/api/*), siempre devolvemos JSON
        // incluso si el cliente olvida enviar el Header 'Accept: application/json'.
        $exceptions->shouldRenderJsonWhen(function ($request, $e) {
            if ($request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });
    })->create();
