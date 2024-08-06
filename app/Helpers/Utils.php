<?php

namespace App\Helpers;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Utils
{
    public static function exceptionReturn(\Throwable $e): JsonResponse
    {
        $code = $e->getCode();

        if ($e->getCode() == 0) {
            $code = 500;
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'message' => 'Alguns parametros foram enviados incorretamente. Por favor, verifique e tente novamente.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof QueryException) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            $message = 'Ocorreu um erro interno do servidor. Por favor, tente novamente mais tarde.';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            abort(response()->json([
                'message' => $message,
            ], 500));
        }

        return response()->json([
            'message' => $e->getMessage(),
        ], $code);
    }
}
