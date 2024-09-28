@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->photo_gallery) ? asset('storage/uploads/photo/'.$global_banner->photo_gallery) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Photo Gallery</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Photo Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <div class="container">
        <div class="row">

            {{-- @foreach ($photos as $photo)
                <div class="col-md-6 col-lg-3">
                    <h2 class="photo-gallery-heading pt_30">{{ $photo->photoCategory->name }}</h2>
                    <div class="photo-gallery-item mb_25">
                        <div class="photo-gallery-item-bg"></div>
                        <a href="{{ asset('storage/uploads/photo/'.$photo->photo) }}" class="magnific" title="">
                            <img src="{{ asset('storage/uploads/photo/'.$photo->photo) }}">
                            <div class="plus-icon"><i class="fas fa-search-plus"></i></div>
                        </a>
                    </div>
                </div>
            @endforeach --}}

            @php
                $previousCategory = null;
            @endphp

            @foreach ($photos as $photo)
                @if ($previousCategory != $photo->photoCategory->name)
                    <div class="col-md-12">
                        <h2 class="photo-gallery-heading pt_30">{{ $photo->photoCategory->name }}</h2>
                    </div>
                    @php
                        $previousCategory = $photo->photoCategory->name;
                    @endphp
                @endif

                <div class="col-md-6 col-lg-3">
                    <div class="photo-gallery-item mb_25">
                        <div class="photo-gallery-item-bg"></div>
                        <a href="{{ asset('storage/uploads/photo/'.$photo->photo) }}" class="magnific" title="">
                            <img src="{{ asset('storage/uploads/photo/'.$photo->photo) }}">
                            <div class="plus-icon"><i class="fas fa-search-plus"></i></div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
