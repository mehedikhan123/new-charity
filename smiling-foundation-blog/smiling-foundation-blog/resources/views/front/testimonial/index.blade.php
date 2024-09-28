@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->testimonial) ? asset('storage/uploads/photo/'.$global_banner->testimonial) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Testimonials</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Testimonial List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog my-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center">
            @foreach ($testimonials as $testimonial)                
                <div class="col-lg-4 col-md-6">
                    <div class="item shadow p-4" style="height: 58vh;">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'. $testimonial->photo) }}" alt="testimonial photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;">
                        </div>
                        <div class="text">
                            @php
                                $maxLength = 25;
                                $name = $testimonial->name;
                            @endphp
                            @if(strlen($name) > $maxLength) 
                                <h3 class="my-2">
                                    {!! substr($name, 0, $maxLength) . '...' !!}
                                </h3>
                                @else
                                <h3 class="my-2">{!! $testimonial->name !!}</h3>
                            @endif
                            <h5>{{ $testimonial->designation }}</h5>
                            <div style="height: 10vh;">
                                @php
                                    $maxLength = 100;
                                    $comment = $testimonial->comment;
                                @endphp
                                @if(strlen($comment) > $maxLength) 
                                    <p>
                                        {!! substr($comment, 0, $maxLength) . '...' !!}
                                    </p>
                                    @else
                                    <p>{!! $testimonial->comment !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('testimonials.show', $testimonial->id) }}" class="btn-style">Read More</i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection