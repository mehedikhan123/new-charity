@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->about_history) ? asset('storage/uploads/photo/'.$global_banner->about_history) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our History</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="full-section">
                    <div class="row gy-5 d-flex align-items-center justify-content-center">
                        @foreach ($historySections as $historySection)
                            {{-- <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s"> --}}
                                {{-- @if(isset($historySection->video))
                                    <div class="" style="background-image: url('{{ asset('storage/uploads/photo/'.$historySection->photo) }}');">
                                        <a class="video-button" href="https://www.youtube.com/watch?v={{ $historySection->video }}"><span></span></a>
                                    </div>
                                    @else --}}
                                    {{-- <div class="">
                                        <img src="{{ asset('storage/uploads/photo/'.$historySection->photo) }}" alt="about image" class="img-fluid" style="object-fit: contain;">
                                    </div> --}}
                                {{-- @endif --}}
                            {{-- </div> --}}
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <img src="{{ asset('storage/uploads/photo/'.$historySection->photo) }}" alt="about image" class="img-fluid" style="object-fit: cover; width: 100%; height: 50vh;">
                            </div>
                            <div class="col-12 mt-3 wow fadeInUp" data-wow-delay="0.1s">
                                {{-- <h5 class="section-title bg-white text-start pe-3">{{ $historySection->sub_heading }}</h5> --}}
                                <h2 class="text-primary">{{ $historySection->heading }}</h2>
                                {!! $historySection->text !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
