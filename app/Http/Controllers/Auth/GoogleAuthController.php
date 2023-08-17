<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'google login failed');
        }

        // Check if the user already exists in your database
        $user = User::where('email', $googleUser->email)->first();


        if (!$user) {
            // If the user doesn't exist, create a new user account
            $user = new User();
            $user->email = $googleUser->email;
            $user->google_id = $googleUser->id;
            $user->password = bcrypt('temporary_password');

            // Split the full name into first name and last name
            $fullNameParts = explode(' ', $googleUser->name);
            $user->first_name = $fullNameParts[0];
            $user->last_name = count($fullNameParts) > 1 ? $fullNameParts[1] : $fullNameParts[0];
            $user->save();
        }
        auth()->login($user);
        return redirect()->route('user.dashboard.home');
    }
}
