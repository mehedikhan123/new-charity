@extends('front.layouts.app')

@section('main_content')
<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                <div class="card card-primary border-box shadow mb-5">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Reset Password</h4>
                    </div>
                    <div class="card-body card-body-auth p-4">
                    {{-- <x-guest-layout> --}}
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" class="form-label" />
                                <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" placeholder="Please enter your email address" autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" class="form-label" />
                                <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password" placeholder="Please enter your password" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                                    type="password"
                                                    name="password_confirmation" placeholder="Please confirm your password" autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </x-primary-button>
                            </div>
                        </form>
                    {{-- </x-guest-layout> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
