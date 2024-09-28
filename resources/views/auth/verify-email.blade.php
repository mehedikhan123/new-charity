@extends('front.layouts.app')

@section('main_content')
<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                <div class="card card-primary border-box shadow mb-5">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Verify Email</h4>
                    </div>
                    <div class="card-body card-body-auth p-4">
                    {{-- <x-guest-layout> --}}
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 d-flex align-items-center justify-content-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <x-primary-button class="btn btn-sm btn-primary">
                                        {{ __('Resend Verification Email') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    {{-- </x-guest-layout> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
