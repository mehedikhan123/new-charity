@extends('front.layouts.app')

@section('main_content')
<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                <div class="card card-primary border-box shadow mb-5">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Forgot Password</h4>
                    </div>
                    <div class="card-body card-body-auth p-4">
                    {{-- <x-guest-layout> --}}
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" class="form-label" />
                                <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" placeholder="Please enter your email address" autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Email Password Reset Link') }}
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