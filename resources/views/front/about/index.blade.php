@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->about_who) ? asset('storage/uploads/photo/'.$global_banner->about_who) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>About Us</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-section">
                    <div class="row gy-5 d-flex align-items-center justify-content-center">
                        @foreach ($aboutSections as $aboutSection)
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                {{-- @if(isset($aboutSection->video))
                                    <div class="" style="background-image: url('{{ asset('storage/uploads/photo/'.$aboutSection->photo) }}');">
                                        <a class="video-button" href="https://www.youtube.com/watch?v={{ $aboutSection->video }}"><span></span></a>
                                    </div>
                                    @else --}}
                                <img src="{{ asset('storage/uploads/photo/'.$aboutSection->photo) }}" alt="about image" class="img-fluid" style="object-fit: cover; width: 100%; height: 50vh;">
                                {{-- @endif --}}
                            </div>
                            <div class="col-12 mt-3 wow fadeInUp" data-wow-delay="0.1s">
                                        {{-- <h5 class="section-title bg-white text-start pe-3">{{ $aboutSection->sub_heading }}</h5> --}}
                                <h2 class="text-primary">{{ $aboutSection->heading }}</h2>
                                {!! $aboutSection->text !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.home.partials.feature')

@include('front.home.partials.facility')

<div class="counter-section pt_70 pb_70">
    <div class="container">
        <div class="row counter-items gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-md-3 counter-item">
                <div class="counter">{{ $counters->counter1_number }}</div>
                <div class="text">{{ $counters->counter1_name }}</div>
            </div>
            <div class="col-md-3 counter-item">
                <div class="counter">{{ $counters->counter2_number }}</div>
                <div class="text">{{ $counters->counter2_name }}</div>
            </div>
            <div class="col-md-3 counter-item">
                <div class="counter">{{ $counters->counter3_number }}</div>
                <div class="text">{{ $counters->counter3_name }}</div>
            </div>
            <div class="col-md-3 counter-item">
                <div class="counter">{{ $counters->counter4_number }}</div>
                <div class="text">{{ $counters->counter4_name }}</div>
            </div>
        </div>
    </div>
</div>

@endsection
