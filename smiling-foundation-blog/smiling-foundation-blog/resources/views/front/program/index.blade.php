@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->program) ? asset('storage/uploads/photo/'.$global_banner->program) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Programs</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Program List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog my-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center">
            @foreach ($programs as $program)                
                <div class="col-lg-4 col-md-6">
                    <div class="item shadow p-4" style="height: 54vh;">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'. $program->photo) }}" alt="program photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;">
                        </div>
                        {{-- <div class="text">
                            @php
                                $maxLength = 24;
                                $name = $program->name;
                            @endphp
                            @if(strlen($name) > $maxLength) 
                                <h4 class="my-2">
                                    {!! substr($name, 0, $maxLength) . '...' !!}
                                </h4>
                                @else
                                <h4 class="my-2">{!! $program->name !!}</h4>
                            @endif
                            <h6 class="my-2">{{ ucfirst($program->type) }}</h6>
                            <div style="height: 10vh;">
                                @php
                                    $maxLength = 100;
                                    $shortDescription = $program->short_description;
                                @endphp
                                @if(strlen($shortDescription) > $maxLength) 
                                    <p>
                                        {!! substr($shortDescription, 0, $maxLength) . '...' !!}
                                    </p>
                                    @else
                                    <p>{!! $shortDescription !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('programs.show', $program->slug) }}" class="btn-style">Read More></i>
                            </a>
                        </div> --}}
                        <div class="text">
                            <div style="height: 16vh;">
                                @php
                                    $startDate = \Carbon\Carbon::parse($program->start_date_time);
                                    $endDate = \Carbon\Carbon::parse($program->end_date_time);
                                @endphp

                                <span class="fw-bold text-primary">
                                    <i class="fa fa-calendar text-primary me-2"></i>
                                    <span>{{ $startDate->format('d') }} - {{ $endDate->format('d M Y') }}</span>
                                </span>
                                @php
                                    $maxLength = 24;
                                    $name = $program->name;
                                @endphp
                                @if(strlen($name) > $maxLength) 
                                    <h4 class="mb-2">
                                        {!! substr($name, 0, $maxLength) . '...' !!}
                                    </h4>
                                    @else
                                    <h4 class="mb-2">{!! $name !!}</h4>
                                @endif
                                {{-- <h4 class="mb-2">{{ $program->name }}</h4> --}}
                                <p><i class="fa fa-briefcase text-primary me-2"></i>{{ ucfirst($program->type) }} <br><span><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $program->location }}</span></p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('programs.show', $program->slug) }}" class="btn-style">Read More 
                                <!--<i class="fas fa-long-arrow-alt-right"></i>-->
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection