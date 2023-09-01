<div class="col-md-6 mb-5 mb-md-0">
    <h2 class="h3 mb-3 text-black">Billing Details</h2>
    <form
        action="{{ isset($shipping_address) ? route('account.address.update', $shipping_address->id) : route('account.address.save') }}"
        method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="p-3 p-lg-5 border">
            <div class="default-form">
                <div class="form-group">
                    <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{ $shipping_address->country ?? '' }}"
                        name="country" id="c_country" placeholder="Enter a country">
                    @error('country')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control readonly-input" readonly id="c_fname"
                                value="{{ $user->first_name }}">
                        </div>
                        <div class="edit-profile-message">Edit this on your profile page</div>

                    </div>
                    <div class="col-md-6">
                        <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control readonly-input" readonly id="c_lname"
                                value="{{ $user->last_name }}">
                        </div>
                        <div class="edit-profile-message">Edit this on your profile page</div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $shipping_address->address ?? '' }}"
                            id="c_address" name="address" placeholder="Street address">
                    </div>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="c_state_country" class="text-black">State <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $shipping_address->state ?? '' }}"
                            id="c_state_country" name="state">
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="c_postal_zip" class="text-black">Postal / Zip <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $shipping_address->zip_code ?? '' }}"
                            id="zip_code" name="zip_code">
                        @error('zip_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-5">

                    <div class="col-md-6">
                        <label for="c_email_address" class="text-black">Email Address <span
                                class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control readonly-input" readonly id="c_email_address"
                                value="{{ $user->email }}">
                        </div>
                        <div class="edit-profile-message">Edit this on your profile page</div>

                    </div>
                    <div class="col-md-6">
                        <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $shipping_address->phone_no ?? '' }}"
                            id="c_phone" placeholder="Phone Number " name="phone_no">
                        @error('phone_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


            </div>

            {{-- <div class="form-group">
                <label for="c_ship_different_address" class="text-black" data-toggle="collapse"
                    href="#ship_different_address" role="button" aria-expanded="false"
                    aria-controls="ship_different_address"><input type="checkbox" value="1"
                        id="c_ship_different_address"> Ship To A Different Address?</label>
                <div class="collapse" id="ship_different_address">
                    <div class="py-2">
                        <div class="form-group">
                            <label for="c_country" class="text-black">Country <span
                                    class="text-danger">*</span></label>
                            <select id="c_country" class="form-control" wire:model="country">
                                <option value="1">Select a country</option>
                                <option value="2">Bangladesh</option>
                                <option value="3">Algeria</option>
                                <option value="4">Afghanistan</option>
                                <option value="5">Ghana</option>
                                <option value="6">Albania</option>
                                <option value="7">Bahrain</option>
                                <option value="8">Colombia</option>
                                <option value="9">Dominican Republic</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">First Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" disabled id="c_fname"
                                    value="{{ $user->first_name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Last Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" disabled id="c_lname"
                                    value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" wire:model="address"
                                    placeholder="Street address">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Apartment, suite, unit etc. (optional)">
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">State <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_state_country" wire:model="state">
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Postal / Zip <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip_code" wire:model="zip_code">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" disabled id="c_email_address"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">Phone <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" wire:model="phone"
                                    placeholder="Phone Number">
                            </div>
                        </div>

                    </div>

                </div>
            </div> --}}

            <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                    placeholder="Write your notes here...">{{ $shipping_address->order_notes ?? '' }}</textarea>
            </div>
            <div class="form-group d-flex justify-content-center">
                <button class="btn btn-primary btn-md w-100">Save address</button>
            </div>

        </div>
    </form>
</div>
