<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Country;
use Livewire\Component;

class ShippingAddress extends Component
{
    public $country;
    public $address;
    public $state;
    public $zip_code;
    public $phone_no;
    public $order_notes;
    public $ship_different_address;

    public $user;
    public $searchQuery;


    protected $rules = [
        'country' => 'required|max:255',
        'address' => 'required|max:255',
        'state' => 'required|max:255',
        'zip_code' => 'required|max:255',
        'phone_no' => 'required|max:255',
        'order_notes' => 'nullable|max:1500',

    ];

    protected $messages = [
        'country.required' => 'The country field is required.',
        'country.max' => 'The country field must not exceed 255 characters.',
        'address.required' => 'The address field is required.',
        'address.max' => 'The address field must not exceed 255 characters.',
        'state.required' => 'The state field is required.',
        'state.max' => 'The state field must not exceed 255 characters.',
        'zip_code.required' => 'The postal/zip code field is required.',
        'zip_code.max' => 'The postal/zip code field must not exceed 255 characters.',
        'phone_no.required' => 'The phone number field is required.',
        'phone_no.max' => 'The phone number field must not exceed 255 characters.',
        'order_notes.max' => 'The order notes field must not exceed 1500 characters.',
    ];

    public function mount()
    {
        $this->user = Auth::user();

    }

    public function saveAddress()
    {
        $this->validate();

        if ($this->ship_different_address) {
            // Save or update the shipping address
            $shippingAddress = Address::updateOrCreate(
                ['user_id' => auth()->user()->id, 'mark_as_default' => 1],
                [
                    'country' => $this->country,
                    'address' => $this->address,
                    'state' => $this->state,
                    'zip_code' => $this->zip_code,
                    'phone_no' => $this->phone_no,
                    'order_notes' => $this->order_notes,
                ]
            );
        } else {
            // Save or update the default address (same as profile)
            $defaultAddress = Address::updateOrCreate(
                ['user_id' => auth()->user()->id, 'mark_as_default' => 1],
                [
                    'country' => $this->country,
                    'address' => $this->address,
                    'state' => $this->state,
                    'zip_code' => $this->zip_code,
                    'phone_no' => $this->phone_no,
                    'order_notes' => $this->order_notes,
                ]
            );
        }

        session()->flash('success_message', 'Shipping address updated successfully.');
    }

    public function searchCountries()
    {
        $query = request('query');
        $countries = Country::where('name', 'like', '%' . $query . '%')->get();
        return response()->json($countries);
    }

    public function render()
    {
        $countries = Country::where('name', 'like', '%' . $this->searchQuery . '%')->get();
        $shopping_address = Address::where('mark_as_default', '1')->where('user_id', auth()->user()->id)->find(1);
        return view('livewire.shipping-address', [
            'countries' => $countries,
            'shopping_address' => $shopping_address,
        ]);
    }
}
