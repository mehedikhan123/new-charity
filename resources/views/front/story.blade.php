@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->story) ? asset('storage/uploads/photo/'.$global_banner->story) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Successful Story</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Successful Story</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog my-5">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-12">
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
                                <a href="{{ route('successful-story.show', $post->slug) }}" class="btn-style">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
