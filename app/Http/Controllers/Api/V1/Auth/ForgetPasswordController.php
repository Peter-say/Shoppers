<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Mail\Api\ResetPasswordMail;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{

    public function forgetPassword(Request $request)
    {
        try {
         $response = AuthService::sendCode($request);
            return $response;
        } catch (Exception $e) {
            return ApiHelper::errorResponse('Could not send reset code. Please, try again', $e->getMessage());
        }
    }
}
