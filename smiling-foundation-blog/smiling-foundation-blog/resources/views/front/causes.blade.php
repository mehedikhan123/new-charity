@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->be_sponsor) ? asset('storage/uploads/photo/'.$global_banner->be_sponsor) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Causes</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Causes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="cause my-5">
    <div class="container">
        <div class="row">

            @foreach($causes as $item)
            <div class="col-lg-4 col-md-6 shadow p-4" style="height: 54vh;">
                <div class="item">
                    <div class="photo">
                        <img src="{{ asset('storage/uploads/photo/'.$item->featured_photo) }}" alt="" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;">
                    </div>
                    <div class="text">
                        <h2>
                            <a href="{{ route('cause.show', $item->slug) }}">{{ $item->name }}</a>
                        </h2>
                        @isset($item->orphans)
                        <small>
                            <span>
                                <span class="fw-bold">Age</span> : {{ $item->orphans->age }}
                            </span>
                            <br>
                            <span>
                                <span class="fw-bold">Gender</span> : {{ $item->orphans->gender }}
                            </span>
                        </small>
                        @endisset
                        <div class="short-des">
                            <p>
                                {!! nl2br($item->short_description) !!}
                            </p>
                        </div>
                        @php
                            $perc = ($item->raised / $item->goal) * 100;
                            $perc = ceil($perc);
                        @endphp
                        <div class="progress mb_10">
                            <div class="progress-bar w-0" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100" style="animation: progressAnimation{{ $loop->iteration }} 2s linear forwards;"></div>
                            <style>
                                @keyframes progressAnimation{{ $loop->iteration }} {
                                    from {
                                        width: 0;
                                    }
                                    to {
                                        width: {{ $perc }}%;
                                    }
                                }
                            </style>
                        </div>
                        <div class="lbl mb_20">
                            <div class="goal">Goal: ${{ $item->goal }}</div>
                            <div class="raised">Raised: ${{ $item->raised }}</div>
                        </div>
                        <div class="">
                            <a class="btn-style" href="{{ route('cause.show', $item->slug) }}">Sponsor me</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>

@endsection
