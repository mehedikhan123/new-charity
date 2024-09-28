@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $cause->name }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cause.index') }}">Causes</a></li>
                        <li class="breadcrumb-item active">{{ $cause->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="cause-detail my-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- <div class=""> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/uploads/photo/'.$cause->featured_photo) }}" alt="" class="img-fluid" style="max-height: 50vh; object-fit:contain;">
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <h2 class="mt_30">Information</h2>
                                <div class="summary">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td><b>Name</b></td>
                                                <td>{{ $cause->orphans->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Date Of Birth:</b></td>
                                                <td>{{ $cause->orphans->date_of_birth }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Country</b></td>
                                                <td>Bangladesh</td>
                                            </tr>
                                            {{-- Fatema Akter
                                                    Date Of Birth: 2019-05-04
                                                    Dream: Doctor
                                                    Country: Bangladesh
                                                    Amount: 2750 --}}
                                            <tr>
                                                <td><b>Goal</b></td>
                                                <td>${{ $cause->goal }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Raised</b></td>
                                                <td>${{ $cause->raised }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Remaining</b></td>
                                                <td>${{ ($cause->goal-$cause->raised) }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Percentage</b></td>
                                                @php
                                                    $perc = ($cause->raised / $cause->goal) * 100;
                                                    $perc = ceil($perc);
                                                @endphp
                                                <td>{{ $perc }}%</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
            
            
                                {{-- <h2 class="mt_30">Recent Causes</h2>
                                <ul>
                                    @foreach($recent_causes as $item)
                                    <li><a href="{{ route('cause.show',$item->slug) }}"><i class="fas fa-angle-right"></i> {{ $item->name }}</a></li>
                                    @endforeach
                                </ul> --}}
            
            
                                {{-- <h2 class="mt_30">Cause Enquery</h2>
                                <div class="enquery-form">
                                    <form action="{{ route('cause.send-message') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                                        <div class="mb-3">
                                            <input name="name" type="text" class="form-control" placeholder="Full Name">
                                        </div>
                                        <div class="mb-3">
                                            <input name="email" type="email" class="form-control" placeholder="Email Address">
                                        </div>
                                        <div class="mb-3">
                                            <input name="phone" type="text" class="form-control" placeholder="Phone Number (Optional)">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="message" class="form-control h-150" rows="3" placeholder="Message"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">
                                                Send Message <i class="fas fa-long-arrow-alt-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @php
                        $perc = ($cause->raised / $cause->goal) * 100;
                        $perc = ceil($perc);
                    @endphp
                    <div class="progress mb_10">
                        <div class="progress-bar w-0" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100" style="animation: progressAnimation1 2s linear forwards;"></div>
                        <style>
                            @keyframes progressAnimation1 {from {width: 0;}to {width: {{ $perc }}%;}}
                        </style>
                    </div>
                    <div class="lbl mb_20">
                        <div class="raised">Raised: ${{ $cause->raised }}</div>
                        <div class="goal">Goal: ${{ $cause->goal }}</div>
                    </div>
                {{-- </div> --}}
                <div class="mt-2 mb-4">
                    <a href="{{ route('donate.show', $cause->slug) }}" class="btn-donate btn btn-lg">Donate</a>
                </div>
                <div class="">
                    {{-- <h2>
                        Photos
                    </h2> --}}
                    <div class="photo-all">
                        <div class="row">
                            <div class="col-12">
                                {!! $cause->description !!}
                            </div>
                            @foreach($causePhotos as $causePhoto)
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ asset('storage/uploads/photo/'.$causePhoto->photo) }}" class="magnific">
                                        <img src="{{ asset('storage/uploads/photo/'.$causePhoto->photo) }}" alt="" />
                                        <div class="icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="bg"></div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="">
                    {{-- <h2>
                        Videos
                    </h2> --}}
                    <div class="video-all">
                        <div class="row">
                            @foreach($causeVideos as $causeVideo)
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a class="video-button" href="http://www.youtube.com/watch?v={{ $causeVideo->video }}">
                                        <img src="http://img.youtube.com/vi/{{ $causeVideo->video }}/0.jpg" alt="" />
                                        <div class="icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                        <div class="bg"></div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class=" faq-cause">
                    {{-- <h2>
                        FAQ
                    </h2> --}}
                    <div class="accordion" id="accordionExample">
                        @foreach($causeFaqs as $causeFaq)
                        <div class="accordion-item mb_30">
                            <h2 class="accordion-header" id="heading_{{ $loop->iteration }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse_{{ $loop->iteration }}">
                                    {{ $causeFaq->question }}
                                </button>
                            </h2>
                            <div id="collapse_{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $loop->iteration }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $causeFaq->answer !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
$(document).ready(function () {
    $("#donation-amount").val("50");
    $(".donation-button").on('click',function () {
        $(".donation-button").removeClass("selected");
        var amount = $(this).data("amount");
        $("#donation-amount").val(amount);
        $(this).addClass("selected");
        if (amount === "") {
            $("#donation-amount").focus();
        }
    });
});
</script> --}}
@endsection
