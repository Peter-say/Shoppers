<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Constants\StatusConstants;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{

    public function saveAddress(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'address' => 'required|max:255',
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'zip_code' => 'required|max:255',
            'phone_no' => 'required|', 'regex:/^\d{3}-\d{3}-\d{4}$/',
            'order_notes' => 'nullable',
        ]);

        $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'phone_no' => $request->phone_no,
            'order_notes' => $request->order_notes,
        ];

        if ($request->mark_as_default == 1) {
            Address::where('user_id', $user->id)->update(['mark_as_default' => 0]);
            $data['mark_as_default'] = 1;
        }

        Address::updateOrCreate(['user_id' => $user->id], $data);
        return redirect()->back()->with('success_message', 'Shipping address updated successfully.');

    }
}
