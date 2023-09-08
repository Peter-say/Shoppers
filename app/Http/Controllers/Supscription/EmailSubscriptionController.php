<?php

namespace App\Http\Controllers\Supscription;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmailSubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email|unique']);

            $email = EmailSubscription::first();
            if ($email->exists) {
                // dd('Email already exist');
                return back()->with('error_message, Email already exist');
            } else {
                EmailSubscription::create(['email' => $request->email]);
                return back()->with('success_message', 'You have successfully subscribed to our newsletter.
                New product updates will be rolling out soon');
            }
        } catch (ValidationException) {
            return back()->with('error_message', 'Your email seems not to be working. Please, check and try again');
        } catch (Exception) {
            return back()->with('error_message, Something went wrong');
        }
    }
}
