<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ErrorHandler extends Exception
{
    public function handle(\Throwable $exception)
    {
        Log::error($exception->getMessage());
        return new JsonResponse([
            'status' => false,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ], 500);
    }
}
