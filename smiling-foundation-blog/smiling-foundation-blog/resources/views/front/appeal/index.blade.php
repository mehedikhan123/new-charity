@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->appeal) ? asset('storage/uploads/photo/'.$global_banner->appeal) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Appeals</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appeal List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog my-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center">
            @foreach ($appeals as $appeal)                
                <div class="col-lg-4 col-md-6">
                    <div class="item shadow p-4" style="height: 54vh;">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'. $appeal->photo) }}" alt="appeal photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;">
                        </div>
                        <div class="text">
                            @php
                                $maxLength = 25;
                                $name = $appeal->name;
                            @endphp
                            @if(strlen($name) > $maxLength) 
                                <h4 class="my-2">
                                    {!! substr($name, 0, $maxLength) . '...' !!}
                                </h4>
                                @else
                                <h4 class="my-2">{!! $appeal->name !!}</h4>
                            @endif
                            <div style="height: 10vh;">
                                @php
                                    $maxLength = 100;
                                    $description = $appeal->description;
                                @endphp
                                @if(strlen($description) > $maxLength) 
                                    <p>
                                        {!! substr($description, 0, $maxLength) . '...' !!}
                                    </p>
                                    @else
                                    <p>{!! $appeal->description !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('appeals.show', $appeal->slug) }}" class="btn-style">Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection