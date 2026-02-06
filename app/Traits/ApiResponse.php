<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait para estandarizar las respuestas JSON de la API.
 * Proporciona métodos consistentes para responder con éxito o error.
 */
trait ApiResponse
{
    /**
     * Respuesta de éxito.
     *
     * @param mixed $data Datos a devolver.
     * @param string|null $message Mensaje opcional.
     * @param int $code Código de estado HTTP (por defecto 200).
     * @return JsonResponse
     */
    protected function successResponse($data, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Respuesta de error.
     *
     * @param string|null $message Mensaje de error.
     * @param int $code Código de estado HTTP.
     * @return JsonResponse
     */
    protected function errorResponse($message = null, $code): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
