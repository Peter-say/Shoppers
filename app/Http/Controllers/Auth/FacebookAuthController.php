<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Facebook login failed');
        }

        // Check if the user already exists in your database
        $user = User::where('email', $facebookUser->email)->first();

        if (!$user) {
            // If the user doesn't exist, create a new user account
            $user = new User();
            $user->name = $facebookUser->name;
            $user->email = $facebookUser->email;
            $user->facebook_id = $facebookUser->id;
            $user->first_name = $facebookUser->user['first_name'];
            $user->last_name = $facebookUser->user['last_name'];
            $user->save();
        }
        auth()->login($user);
        return redirect()->route('user.dashboard.home');
    }

    // FacebookDataDeletionController.php
    public function handleDataDeletion(Request $request)
    {
        // Validate the deletion request if you're using a secret key

        $user = User::where('facebook_id', $request->facebook_id)->first();

        if ($user) {
            // Delete user data from your database
            $user->delete();
        }

        return response()->json(['message' => 'User data deleted successfully']);
    }
}
