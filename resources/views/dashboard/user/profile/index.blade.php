@extends('web.layouts.app')

<style>
    .profile-imge {
        height: 20vh;
    }
</style>
@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><strong class="text-black"><span class="text-primary">{{ Auth::user()->full_name }}
                        </span>Profile<span></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            @include('notifications.flash-messages')

            <form action="{{ route('user.dashboard.profile.update') }}" enctype="multipart/form-data" method="POST">
                @csrf @method('PUT')
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <h2 class="h3 mb-3 text-black d-flex justify-content-center">Profile Details</h2>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-5 mb-md-0">

                        <div class="p-3 p-lg-5 border">

                            <div class="form-group row">

                                <div class="col-12 d-flex justify-content-center">
                                    <div class="profile-container">
                                        @if (!$user->avatar ==null)
                                            <img class="profile-image" src="{{ asset($user->avatar) }}" alt="">
                                        @else
                                            <img class="profile-image img-fluid" src="{{ asset('web/images/avatar.jpeg') }}"
                                                alt="">
                                        @endif
                                        <div class="file-container">
                                            <label for="file-input" class="file-button">
                                                Choose Image
                                                <input type="file" id="file-input"
                                                    class="@error('first_name') is-invalid @enderror" name="avatar"
                                                    accept="image/*">
                                                @error('avatar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="c_fname" value="{{ $user->first_name }}" name="first_name"
                                        value="{{ old('first_name') }}" autocomplete="first_name">
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="c_lname" class="text-black">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="c_lname" value="{{ $user->last_name }}" name="last_name"
                                        value="{{ old('last_name') }}" autocomplete="last_name">
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="c_email_address" value="{{ $user->email }}" name="email"
                                        value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone_no') is-invalid @enderror"
                                        id="c_phone" value="{{ $user->phone_no }}" name="phone_no"
                                        placeholder="Phone Number" value="{{ old('phone_no') }}" autocomplete="phone_no">
                                    @error('phone_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
