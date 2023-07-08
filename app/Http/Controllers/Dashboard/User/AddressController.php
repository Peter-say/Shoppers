<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Constants\StatusConstants;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address' => 'required|max:255',
            'street' => 'required|max:255',
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'zip_code' => 'required|max:255',
            'mark_as_default' => 'required|in:' . implode(',', array_keys(StatusConstants::BOOL_OPTIONS)),
        ]);

        if ($request->mark_as_default == 1) {
            // Unset previous default address
            Address::where('user_id', $request->user_id)->update(['mark_as_default' => 0]);
        }

        $data = [
            'user_id' => $request->user_id,
            'address' => $request->address,
            'street' => $request->street,
            'country' => $request->country,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'mark_as_default' => $request->mark_as_default,
        ];

        Address::create($data);
    }
}

