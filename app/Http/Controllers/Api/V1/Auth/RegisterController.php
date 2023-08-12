<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = AuthService::register($request);
            return ApiHelper::successResponse('User registered successfully');
        } catch (ValidationException $e) {
            return ApiHelper::validationErrorResponse($e);
        }
    }
}
