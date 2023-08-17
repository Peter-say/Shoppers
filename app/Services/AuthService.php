<?php

namespace App\Services;

use App\Helpers\ApiHelper;
use App\Mail\Api\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public static function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $accessToken = $user->createToken('authToken');

        return response()->json(['user' => $user, 'access_token' => $accessToken->plainTextToken], 201);
    }

    public static function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($loginData)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        $accessToken = $user->createToken('authToken');

        return response()->json(['user' => Auth::user(), 'access_token' => $accessToken->plainTextToken]);
    }



    public static function sendCode(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

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
        } catch (ValidationException $e) {
            return ApiHelper::errorResponse('Invalid email address', $e);
        } catch (ModelNotFoundException $e) {
            return ApiHelper::notFoundResponse('Email Address could not be found', $e);
        } catch (Exception $e) {
            return ApiHelper::errorResponse('Could not send reset code. Please try again', $e->getMessage());
        }
        return $data;
    }
}
