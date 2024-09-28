@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $executive->name }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('executive.index') }}">Executives</a></li>
                        <li class="breadcrumb-item active">{{ $executive->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="team-single pt_70 pb_70 bg_f3f3f3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="photo">
                    <img src="{{ asset('storage/uploads/photo/'.$executive->photo) }}" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td>{{ $executive->name }}</td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>{{ $executive->designation }}</td>
                        </tr>

                        {{-- @if($executive->address != '') --}}
                        <tr>
                            <td>Country</td>
                            <td>{{ $executive->country->name }}</td>
                        </tr>
                        {{-- @endif --}}

                        {{-- @if($executive->email != '') --}}
                        <tr>
                            <td>Email Address</td>
                            <td>{{ $executive->email }}</td>
                        </tr>
                        {{-- @endif --}}

                        {{-- @if($executive->phone != '') --}}
                        <tr>
                            <td>Phone</td>
                            <td>{{ $executive->phone }}</td>
                        </tr>
                        {{-- @endif --}}

                        {{-- @if($executive->website != '')
                        <tr>
                            <td>Website</td>
                            <td><a href="{{ $executive->website }}" target="_blank">{{ $executive->website }}</a></td>
                        </tr>
                        @endif --}}

                        {{-- <tr>
                            <td>Social Media</td>
                            <td>
                                <ul>
                                    @if($executive->facebook != '')
                                    <li><a href="{{ $executive->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif

                                    @if($executive->twitter != '')
                                    <li><a href="{{ $executive->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    @endif

                                    @if($executive->linkedin != '')
                                    <li><a href="{{ $executive->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif

                                    @if($executive->instagram != '')
                                    <li><a href="{{ $executive->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </td>
                        </tr> --}}
                    </table>
                </div>
            </div>

            {{-- @if($executive->detail != '')
            <div class="col-md-12 mt_30">
                <h4>Detail</h4>
                <div class="description">
                    {!! nl2br($executive->detail) !!}
                </div>
            </div>
            @endif --}}

        </div>
    </div>
</div>
@endsection
