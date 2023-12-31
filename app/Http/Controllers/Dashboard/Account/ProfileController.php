<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.user.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        //  dd($request->all());
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'avatar' => 'nullable|image',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if ($request->hasFile('avatar')) {
            // Get the path of the old avatar file
            $oldAvatar =  $user->avatar;
            // Delete the old avatar file if it exists
            try {
                if (file_exists( $oldAvatar)) {
                    unlink($oldAvatar);
                }else {
                    $avatarPath = FileHelpers::saveImageRequest($request->file('avatar'), 'users/avatar');
                    $avatarFileName = basename($avatarPath);
                    $user->avatar = $avatarFileName;
                }
            } catch (Exception $e) {
                return redirect()->back()->with('error_message', 'An error occurred. Please try again later.', $e);
            }
        }
        $user->save();
        return back()->with('success_message', 'Profile updated successfully.');
    }
}
