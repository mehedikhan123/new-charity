@extends('front.layouts.app')

@section('main_content')
<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                <div class="card card-primary border-box shadow mb-5">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Confirm Password</h4>
                    </div>
                    <div class="card-body card-body-auth p-4">
                    {{-- <x-guest-layout> --}}
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="form-label" />

                                <x-text-input id="password" class="block mt-1 w-full form-control"
                                                type="password"
                                                name="password"
                                                placeholder="Please enter your password" autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Confirm') }}
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