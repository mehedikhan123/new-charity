@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->contact) ? asset('storage/uploads/photo/'.$global_banner->contact) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Contact</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <!-- Location Start -->
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center">
            <div class="col-md-6">
                <h4 class="text-center">Office in {{ $global_setting_data->map_1_country_name }}</h4>
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/uploads/photo/' . $global_setting_data->map_1_country_photo) }}" alt="" class="img-fluid">
                </div>
                <div class="my-3">
                    <div class="d-flex">
                        <div class="left">
                            <i class="text-primary fas fa-map-marker-alt"></i>
                        </div>
                        <div class="right ms-3">
                            {{ $global_setting_data->contact_address_1 }}
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="left">
                            <i class="text-primary fas fa-phone"></i>
                        </div>
                        <div class="right ms-3">{{ $global_setting_data->contact_phone_1 }}</div>
                    </div>
                    <div class="d-flex">
                        <div class="left">
                            <i class="text-primary fas fa-envelope"></i>
                        </div>
                        <div class="right ms-3">{{ $global_setting_data->contact_email_1 }}</div>
                    </div>
                </div>
                {!! $global_setting_data->map_1 !!}
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Office in {{ $global_setting_data->map_2_country_name }}</h4>
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/uploads/photo/' . $global_setting_data->map_2_country_photo) }}" alt="" class="img-fluid">
                </div>
                <div class="my-3">
                    <div class="d-flex">
                        <div class="left">
                            <i class="text-primary fas fa-map-marker-alt"></i>
                        </div>
                        <div class="right ms-3">
                            {{ $global_setting_data->contact_address_2 }}
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="left">
                            <i class="text-primary fas fa-phone"></i>
                        </div>
                        <div class="right ms-3">{{ $global_setting_data->contact_phone_2 }}</div>
                    </div>
                    <div class="d-flex">
                        <div class="left">
                            <i class="text-primary fas fa-envelope"></i>
                        </div>
                        <div class="right ms-3">{{ $global_setting_data->contact_email_2 }}</div>
                    </div>
                </div>
                {!! $global_setting_data->map_2 !!}
            </div>
        </div>
    </div>
</div>

<div class="mb-5">
    <div class="container">
        <div class="row">
            {{-- @if($global_setting_data->map_1 == '')
            @php $column = 12; @endphp
            @else
            @php $column = 6; @endphp
            @endif --}}
            <h4 class="mb-2">Submit your message</h4>
            <div class="col-12">
                <div class="contact-form">
                    <form action="{{ route('contact.send-message') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input name="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Please enter your name">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Please enter your email">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" rows="3" placeholder="Please enter your message"></textarea>
                            <span class="text-danger">@error('message') {{ $message }} @enderror</span>
                        </div>
                        <div>
                            <button type="submit" class="btn-style">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- @if($global_setting_data->map_1 != '')
            <div class="col-lg-6 col-md-12">
                <div class="map">
                    {!! $global_setting_data->map_1 !!}
                </div>
            </div>
            @endif --}}

        </div>
    </div>
</div>
@endsection
