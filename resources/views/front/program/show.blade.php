@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $program->name }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('programs.index') }}">Programs</a></li>
                        <li class="breadcrumb-item active">{{ $program->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="event-detail pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="left-item">
                    <div class="main-photo">
                        <img src="{{ asset('storage/uploads/photo/'.$program->photo) }}" alt="">
                    </div>
                    <h2>
                        Description
                    </h2>
                    {!! $program->description !!}
                </div>
                @isset($programPhotos)                    
                <div class="left-item">
                    <h2>
                        Photos
                    </h2>
                    <div class="photo-all">
                        <div class="row">
                            @foreach($programPhotos as $programPhoto)
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ asset('storage/uploads/photo/'.$programPhoto->photo) }}" class="magnific">
                                        <img src="{{ asset('storage/uploads/photo/'.$programPhoto->photo) }}" alt="" />
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
                @endisset
                <div class="left-item">
                    <h2>
                        Videos
                    </h2>
                    <div class="video-all">
                        <div class="row">
                            @foreach($programVideos as $programVideo)
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a class="video-button" href="http://www.youtube.com/watch?v={{ $programVideo->youtube_video_id }}">
                                        <img src="http://img.youtube.com/vi/{{ $programVideo->youtube_video_id }}/0.jpg" alt="" />
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

            </div>
            <div class="col-lg-4 col-md-12">

                <div class="right-item">

                    @php
                        $currentTimestamp = \Carbon\Carbon::now();
                        
                        $formattedStartDate = \Carbon\Carbon::parse($program->start_date_time)->format('d F, Y h:i A');
                        $formattedEndDate = \Carbon\Carbon::parse($program->end_date_time)->format('d F, Y h:i A');
                        $programStart = \Carbon\Carbon::parse($program->start_date_time);
                        $programEnd = \Carbon\Carbon::parse($program->end_date_time);
                    @endphp

                    @if($currentTimestamp->lessThan($programStart))
                        {{-- Program has not started yet, countdown to the start date --}}
                        <div class="countdown show" data-StartDate="{{ $program->start_date_time }}" data-EndDate="{{ $program->end_date_time }}">
                            <div class="boxes running">
                                <div class="box">
                                    <div class="num"><timer><span class="days"></span></timer></div>
                                    <div class="name">Days</div>
                                </div>
                                <div class="box">
                                    <div class="num"><timer><span class="hours"></span></timer></div>
                                    <div class="name">Hours</div>
                                </div>
                                <div class="box">
                                    <div class="num"><timer><span class="minutes"></span></timer></div>
                                    <div class="name">Minutes</div>
                                </div>
                                <div class="box">
                                    <div class="num"><timer><span class="seconds"></span></timer></div>
                                    <div class="name">Seconds</div>
                                </div>
                            </div>
                            <div class="program-details">
                                Program will start on <b>{{ $formattedStartDate }}</b>.
                            </div>
                        </div>
                    @elseif($currentTimestamp->between($programStart, $programEnd))
                        {{-- Program has started, countdown to the end date --}}
                        <div class="countdown show" data-StartDate="{{ $program->start_date_time }}" data-EndDate="{{ $program->end_date_time }}">
                            <div class="boxes running">
                                <div class="box">
                                    <div class="num"><timer><span class="days"></span></timer></div>
                                    <div class="name">Days</div>
                                </div>
                                <div class="box">
                                    <div class="num"><timer><span class="hours"></span></timer></div>
                                    <div class="name">Hours</div>
                                </div>
                                <div class="box">
                                    <div class="num"><timer><span class="minutes"></span></timer></div>
                                    <div class="name">Minutes</div>
                                </div>
                                <div class="box">
                                    <div class="num"><timer><span class="seconds"></span></timer></div>
                                    <div class="name">Seconds</div>
                                </div>
                            </div>
                            <div class="program-details">
                                Program is running! It will end on <b>{{ $formattedEndDate }}</b>.
                            </div>
                        </div>
                    @else
                        {{-- Program has ended --}}
                        <div class="text-danger"><b>Program Date is Over!</b></div>
                    @endif

                    <h2 class="mt_30">Program Information</h2>
                    <div class="summary">
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                @if($program->price != 0)
                                <tr>
                                    <td><b>Ticket Price</b></td>
                                    <td class="price">${{ $program->price }}</td>
                                </tr>
                                @endif


                                <tr>
                                    <td><b>Location</b></td>
                                    <td>{{ $program->location }}</td>
                                </tr>
                                
                                <tr>
                                    <td><b>Start Time</b></td>
                                    <td>{{ $formattedStartDate }}</td>
                                </tr>
                                <tr>
                                    <td><b>End Time</b></td>
                                    <td>{{ $formattedEndDate }}</td>
                                </tr>


                                @if($program->total_seat != '')
                                <tr>
                                    <td><b>Total Seat</b></td>
                                    <td>{{ $program->total_seat }}</td>
                                </tr>
                                <tr>
                                    <td><b>Booked</b></td>
                                    <td>
                                        @if($program->booked_seat == '')
                                        0
                                        @else
                                        {{ $program->booked_seat }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Remaining</b></td>
                                    <td>
                                        @php
                                        $remaining = $program->total_seat - $program->booked_seat;
                                        @endphp
                                        {{ $remaining }}
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td><b>Booked</b></td>
                                    <td>
                                        @if($program->booked_seat == '')
                                        0
                                        @else
                                        {{ $program->booked_seat }}
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    @if($currentTimestamp->between($programStart, $programEnd))
                        @if($program->price != 0)
                        <h2 class="mt_30">Buy Ticket</h2>
                        <div class="pay-sec">
                            <form action="{{ route('programs.ticket.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="unit_price" value="{{ $program->price }}">
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <select name="number_of_tickets" class="form-select mb_15">
                                    <option value="">How many tickets?</option>
                                    @for($i=1; $i<=5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="payment_method" class="form-select mb_15">
                                    <option value="">Select Payment Method</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                                <h5 class="mt-3 text-white">Buyer Information</h5>
                                <div class="text-white">
                                    {{-- <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Please enter your name">  --}}
                                    <div class="form-group mb-3 ms-3">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Please enter your name" value="{{ isset($volunteer) ? $volunteer->name : old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3 ms-3">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Please enter your email" value="{{ isset($volunteer) ? $volunteer->email : old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3 ms-3">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Please enter your address" value="{{ isset($volunteer) ? $volunteer->address : old('address') }}">
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3 ms-3">
                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Please enter your phone" value="{{ isset($volunteer) ? $volunteer->phone : old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100-p pay-now">Make Payment</button>
                            </form>
                        </div>
                        @endif

                        @if($program->price == 0)
                        <h2 class="mt_30">Free Booking</h2>
                        <div class="pay-sec">
                            <form action="{{ route('programs.ticket.free-booking') }}" method="post">
                                @csrf
                                <input type="hidden" name="unit_price" value="{{ $program->price }}">
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <select name="number_of_tickets" class="form-select mb_15">
                                    <option value="number_of_tickets">How many tickets?</option>
                                    @for($i=1; $i<=5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="btn btn-primary w-100-p pay-now">Book Now</button>
                            </form>
                        </div>
                        @endif
                    @endif

                    @if($program->map != '')
                    <h2 class="mt_30">Program Map</h2>
                    <div class="location-map">
                        {{ $program->map }}
                    </div>
                    @endif


                    <h2 class="mt_30">Recent Programs</h2>
                    <ul>
                        @foreach($recentPrograms as $program)
                        <li><a href="{{ route('programs.show',$program->slug) }}"><i class="fas fa-angle-right"></i> {{ $program->name }}</a></li>
                        @endforeach
                    </ul>

                    <h2 class="mt_30">Program Enquery</h2>
                    <div class="enquery-form">
                        <form action="{{ route('programs.send-message') }}" method="post">
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
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
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
