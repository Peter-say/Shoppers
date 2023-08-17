<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Mail\Api\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgetPasswordController extends Controller
{

    public function forgetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
        } catch (ValidationException $e) {
            return ApiHelper::errorResponse('Invalid email address', $e);
        } catch (ModelNotFoundException $e) {
            return ApiHelper::notFoundResponse('Email Address could not be found', $e);
        }

        try {
            $user = User::where('email', $request->email)->first();

            // Generate a unique 6-digit numeric code
            $resetCode = mt_rand(100000, 999999);

            // Calculate the expiration time (10 minutes from now)
            $expiration = Carbon::now()->addMinutes(10);

            // Save the reset code and expiration time in the database
          $data =  [
            'email' => $request->email,
            'token' => Hash::make($resetCode),
            'created_at' => Carbon::now(),
            'expires_at' => $expiration,
          ];
          
          DB::table('password_resets')->updateOrInsert(
                ['email' => $request->email],
             $data,
            );
            // Send the reset code to the user's email
            Mail::to($request->email)->send(new ResetPasswordMail($resetCode));

            return ApiHelper::successResponse('Reset code sent to your email', $data);
        } catch (Exception $e) {
            return ApiHelper::errorResponse('Could not send reset code. Please, try again', $e->getMessage());
        }
    }
}
