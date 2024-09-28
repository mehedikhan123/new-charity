@extends('admin.layouts.app')

{{-- @section('page-title', isset($executive) ? 'Edit Executive' : 'Create Executive') --}}

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($executive) ? 'Edit' : 'Create' }} Executive</h1>
            <div>
                <a href="{{ route('admin.executives.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($executive) ? route('admin.executives.update', $executive->id) : route('admin.executives.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($executive)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter your name" value="{{ isset($executive) ? $executive->name : old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="designation">Designation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Please enter your designation" value="{{ isset($executive) ? $executive->designation : old('designation') }}">
                                            @if ($errors->has('designation'))
                                                <span class="text-danger">{{ $errors->first('designation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Please enter your phone number" value="{{ isset($executive) ? $executive->phone : old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Please enter your email address" value="{{ isset($executive) ? $executive->email : old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Select Country <span class="text-danger">*</span></label>
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

                                @isset($executive)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $executive->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($executive) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($errors->has('photo'))
                                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>   
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($executive) ? 'Update' : 'Submit' }}</button>
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
