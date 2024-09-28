@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->video_gallery) ? asset('storage/uploads/photo/'.$global_banner->video_gallery) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Video Gallery</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Video Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <div class="container">
        <div class="row">

            {{-- @foreach ($videoCategories as $videoCategory)
            <div class="col-md-12 mb_15">
                <h2 class="video-gallery-heading pt_30">{{ $videoCategory->name }}</h2>
            </div>

            @foreach ($videoCategory->rVideo as $video)
            <div class="col-md-6 col-lg-3">
                <div class="video-gallery-item mb_25">
                    <div class="video-gallery-item-bg"></div>
                    <a class="video-button" href="http://www.youtube.com/watch?v={{ $video->video }}">
                        <img src="http://img.youtube.com/vi/{{ $video->video }}/0.jpg">
                        <div class="plus-icon"><i class="fas fa-search-plus"></i></div>
                    </a>
                </div>
            </div>
            @endforeach

            @endforeach --}}

            @php
                $previousCategory = null;
            @endphp

            @foreach ($videos as $video)
                @if ($previousCategory != $video->videoCategory->name)
                    <div class="col-md-12">
                        <h2 class="video-gallery-heading pt_30">{{ $video->videoCategory->name }}</h2>
                    </div>
                    @php
                        $previousCategory = $video->videoCategory->name;
                    @endphp
                @endif

                <div class="col-md-6 col-lg-3">
                    <div class="video-gallery-item mb_25">
                        <div class="video-gallery-item-bg"></div>
                        <a class="video-button" href="http://www.youtube.com/watch?v={{ $video->video }}">
                            <img src="http://img.youtube.com/vi/{{ $video->video }}/0.jpg">
                            <div class="plus-icon"><i class="fas fa-search-plus"></i></div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
