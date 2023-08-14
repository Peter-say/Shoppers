<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $data = AuthService::login($request);
            return ApiHelper::successResponse('User logged in successfully', $data);
        } catch (ValidationException $e) {
            return ApiHelper::validationErrorResponse($e);
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            return ApiHelper::errorResponse('Login attempt failed. Invalid credentials.', 401);
        }
    }

   
}
