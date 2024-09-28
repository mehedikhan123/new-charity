@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->news) ? asset('storage/uploads/photo/'.$global_banner->news) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>News</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">News List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog my-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center">
            @foreach ($news as $newsItem)                
                <div class="col-lg-4 col-md-6">
                    <div class="item shadow p-4" style="height: 54vh;">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'. $newsItem->photo) }}" alt="news photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;">
                        </div>
                        <div class="text">
                            @php
                                $maxLength = 25;
                                $title = $newsItem->title;
                            @endphp
                            @if(strlen($title) > $maxLength) 
                                <h4 class="my-2">
                                    {!! substr($title, 0, $maxLength) . '...' !!}
                                </h4>
                                @else
                                <h4 class="my-2">{!! $newsItem->title !!}</h4>
                            @endif
                            <div style="height: 10vh;">
                                @php
                                    $maxLength = 100;
                                    $description = $newsItem->description;
                                @endphp
                                @if(strlen($description) > $maxLength) 
                                    <p>
                                        {!! substr($description, 0, $maxLength) . '...' !!}
                                    </p>
                                    @else
                                    <p>{!! $newsItem->description !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('news.show', $newsItem->slug) }}" class="btn-style">Show More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection