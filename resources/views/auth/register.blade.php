@extends('front.layouts.app')

@section('main_content')
<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                <div class="card card-primary border-box shadow mb-5">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Register</h4>
                    </div>
                    <div class="card-body card-body-auth p-4">
                    {{-- <x-guest-layout> --}}
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" class="form-label" />
                                <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" placeholder="Please enter your name" autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" class="form-label" />
                                <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" placeholder="Please enter your email address" autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" class="form-label" />

                                <x-text-input id="password" class="block mt-1 w-full form-control"
                                                type="password"
                                                name="password"
                                                placeholder="Please enter your password"
                                                required autocomplete="new-password" />

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

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-primary-button class="ms-4 btn btn-primary">
                                    {{ __('Register') }}
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