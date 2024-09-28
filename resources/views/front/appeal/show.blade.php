@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($appeal->photo) ? asset('storage/uploads/photo/'.$appeal->photo) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $appeal->name }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appeal Details</li>
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
                    {{-- <div class="row d-flex justify-content-center align-items-center"> --}}
                        <div class="row"> 
                            {{-- <div class="col-12">
                                <img src="{{ asset('storage/uploads/photo/'.$appeal->photo) }}" alt="about image" class="img-fluid" style="object-fit: cover; width: 100%; height: 50vh;">
                            </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="col-md-6"> --}}
                            <div class="col-12 mt-3">
                                {{-- <div class="inner"> --}}
                                    <h3>{{ $appeal->name }}</h3>
                                    {!! $appeal->description !!}
                                {{-- </div> --}}
                            </div>
                        </div>
                    {{-- </div> --}}
                    <div class="row mt-4">
                        <div class="col">
                            @isset($appealPhotos)
                            <div class="">
                                {{-- <h4>
                                    Photos
                                </h4> --}}
                                <div class="photo-all">
                                    <div class="row">
                                        @foreach($appealPhotos as $appealPhoto)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="item">
                                                <a href="{{ asset('storage/uploads/photo/'.$appealPhoto->photo) }}" class="magnific">
                                                    <img src="{{ asset('storage/uploads/photo/'.$appealPhoto->photo) }}" alt="" />
                                                    <div class="icon">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endisset

                            @isset($appealVideos)
                            <div class="">
                                {{-- <h4>
                                    Videos
                                </h4> --}}
                                <div class="video-all">
                                    <div class="row">
                                        @foreach($appealVideos as $appealVideo)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="item">
                                                <a class="video-button" href="http://www.youtube.com/watch?v={{ $appealVideo->video }}">
                                                    <img src="http://img.youtube.com/vi/{{ $appealVideo->video }}/0.jpg" alt="" />
                                                    <div class="icon">
                                                        <i class="far fa-play-circle"></i>
                                                    </div>
                                                    <div class="bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection