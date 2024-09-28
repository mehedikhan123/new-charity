@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->executive) ? asset('storage/uploads/photo/'.$global_banner->executive) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Executives</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Executives</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog my-5">
    <div class="container">
        <div class="row">
            @foreach($executives as $executive)
            <div class="col-lg-3 col-md-6 shadow p-4" style="height: 40vh;">
                <div class="item">
                    <div class="photo">
                        <img src="{{ asset('storage/uploads/photo/'.$executive->photo) }}" alt="Executive Photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;" />
                    </div>
                    <div class="text">
                        @php
                            $maxLength = 25;
                            $name = $executive->name;
                        @endphp
                        @if(strlen($name) > $maxLength) 
                            <h4 class="my-2">
                                {!! substr($name, 0, $maxLength) . '...' !!}
                            </h4>
                            @else
                            <h4 class="my-2">{!! $executive->name !!}</h4>
                        @endif
                        @php
                            $maxLength = 25;
                            $designation = $executive->designation;
                        @endphp
                        @if(strlen($designation) > $maxLength) 
                            <p class="my-2">
                                {!! substr($designation, 0, $maxLength) . '...' !!}
                            </p>
                            @else
                            <p class="my-2">{!! $executive->designation !!}</p>
                        @endif
                    </div>
                    {{-- <div class="mt-3">
                        <a href="{{ route('executive.show',$executive->id) }}" class="btn-style">Read More</a>
                    </div> --}}
                </div>
            </div>
            @endforeach
            {{-- <div class="col-md-12">
                {{ $executives->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
