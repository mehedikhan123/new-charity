@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Testimonials</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Testimonial Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="right-side">
                                <img src="{{ asset('storage/uploads/photo/'.$testimonial->photo) }}" alt="about image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="left-side">
                                <div class="inner">
                                    <h3>{{ $testimonial->name }}</h3>
                                    <h5>{{ $testimonial->name }}</h5>
                                    {!! $testimonial->comment !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection