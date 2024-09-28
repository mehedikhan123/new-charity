@extends('user.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-3">
                                        @if(Auth::guard('web')->user()->photo != null)
                                            <img src="{{ asset('storage/uploads/photo/'.Auth::guard('web')->user()->photo) }}" alt="" class="profile-photo w_100_p">
                                        @else
                                            <img src="{{ asset('uploads/default.png') }}" alt="" class="profile-photo w_100_p">
                                        @endif
                                        <input type="file" class="mt_10" name="photo">
                                        @if ($errors->has('photo'))
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label class="form-label">Name *</label>
                                            <input type="text" class="form-control" name="name" value="{{ Auth::guard('web')->user()->name }}" autocomplete="off">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Email *</label>
                                            <input type="text" class="form-control" name="email" value="{{ Auth::guard('web')->user()->email }}" autocomplete="off">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Phone *</label>
                                            <input type="text" class="form-control" name="phone" value="{{ Auth::guard('web')->user()->phone }}" autocomplete="off">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label>Select Country</label>
                                            <select name="country_id" class="form-select">
                                                <option value="">Please select any country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if(isset($executive) && $country->id == $executive->country_id) selected @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Retype Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
