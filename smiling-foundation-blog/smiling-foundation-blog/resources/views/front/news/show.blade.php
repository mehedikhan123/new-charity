@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $news->title }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">News</a></li>
                        <li class="breadcrumb-item active">{{ $news->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="post pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="left-item">
                    <div class="main-photo">
                        <img src="{{ asset('storage/uploads/photo/'.$news->photo) }}" alt="" class="img-fluid" style="object-fit: cover; width: 100%; height: 50vh;">
                    </div>
                    <h3>{{ $news->title }}</h3>
                    <div class="sub">
                        <ul>
                            <li><i class="fas fa-calendar-alt"></i> On: {{ $news_date }}</li>
                        </ul>
                    </div>
                    <div class="description">
                        {!! nl2br($news->description) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
