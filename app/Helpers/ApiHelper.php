<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiHelper
{
    public static function successResponse($message, $data = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function errorResponse($message, $status = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    public static function notFoundResponse($message, $status = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    public static function validationErrorResponse($message, $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
