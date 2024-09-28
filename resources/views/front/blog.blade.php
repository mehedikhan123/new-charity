@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->blog) ? asset('storage/uploads/photo/'.$global_banner->blog) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog my-5">
    <div class="container">
        <div class="row gy-4">
            {{-- Blog Section --}}
            <div class="col-md-9">
                @foreach($posts as $post)
                    @if ($post->rPostCategory->slug !== 'successful-stories')
                        <div class="item row shadow p-4 mb-4">
                            <div class="photo col-md-4">
                                <img src="{{ asset('storage/uploads/photo/'.$post->photo) }}" alt="blog photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;" />
                            </div>
                            <div class="text col-md-8">
                                @php
                                    $maxLength = 25;
                                    $title = $post->title;
                                @endphp
                                @if(strlen($title) > $maxLength) 
                                    <h4 class="my-2">{{ substr($title, 0, $maxLength) . '...' }}</h4>
                                @else
                                    <h4 class="my-2">{{ $post->title }}</h4>
                                @endif

                                <div style="height: 6vh;">
                                    @php
                                        $maxLength = 100;
                                        $shortDescription = $post->short_description;
                                    @endphp
                                    @if(strlen($shortDescription) > $maxLength) 
                                        <p>{{ substr($shortDescription, 0, $maxLength) . '...' }}</p>
                                    @else
                                        <p>{{ $post->short_description }}</p>
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('post.show', $post->slug) }}" class="btn-style">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- News Section --}}
            <div class="col-md-3 shadow p-4 mb-4">
                <h3>Latest News</h3>
                <marquee direction="up" scrollamount="3" style="height: 300px;">
                    @foreach($news as $newsItem)
                        <div class="news-item mb-3">
                            <h5 class="">
                                <a href="{{ route('news.show', $newsItem->slug) }}">{{ $newsItem->title }}</a>
                            </h5>
                            <small>
                                @php
                                    $date = \Carbon\Carbon::parse($newsItem->created_at);
                                @endphp
                                <strong>{{ $date->format('l, F j, Y') }}</strong>
                                <br>
                                <em>{{ $date->format('h:i A') }}</em>
                            </small>
                            {{-- <p>{{ substr($newsItem->short_description, 0, 100) }}...</p> --}}
                        </div>
                    @endforeach
                </marquee>
                <div class="mt-3">
                    <a href="{{ route('news.index') }}" class="btn-style">Show More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
