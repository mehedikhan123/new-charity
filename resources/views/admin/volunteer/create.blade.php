@extends('admin.layouts.app')

{{-- @section('page-title', isset($volunteer) ? 'Edit Volunteer' : 'Create Volunteer') --}}

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($volunteer) ? 'Edit' : 'Create' }} Volunteer</h1>
            <div>
                <a href="{{ route('admin.volunteers.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($volunteer) ? route('admin.volunteers.update', $volunteer->id) : route('admin.volunteers.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($volunteer)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <select name="title" class="form-select">
                                                <option value="">Please select any title</option>
                                                @foreach ($nameTitles as $nameTitle)
                                                    <option value="{{ $nameTitle['value'] }}" @if(isset($volunteer) && $volunteer->title == $nameTitle['value']) selected @endif>{{ $nameTitle['text'] }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('title'))
                                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Please enter your first name" value="{{ isset($volunteer) ? $volunteer->first_name : old('first_name') }}">
                                            @if ($errors->has('first_name'))
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Please enter your last name" value="{{ isset($volunteer) ? $volunteer->last_name : old('last_name') }}">
                                            @if ($errors->has('last_name'))
                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="dob" id="dob" placeholder="Please enter your date of birth" value="{{ isset($volunteer) ? $volunteer->dob : old('dob') }}">
                                            @if ($errors->has('dob'))
                                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="age">Age <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="age" id="age" placeholder="Please enter your age" value="{{ isset($volunteer) ? $volunteer->age : old('age') }}" min="0">
                                            @if ($errors->has('age'))
                                                <span class="text-danger">{{ $errors->first('age') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="occupation">Occupation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Please enter your occupation" value="{{ isset($volunteer) ? $volunteer->occupation : old('occupation') }}">
                                            @if ($errors->has('occupation'))
                                                <span class="text-danger">{{ $errors->first('occupation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="institute">Institute</label>
                                            <input type="text" class="form-control" name="institute" id="institute" placeholder="Please enter your institute" value="{{ isset($volunteer) ? $volunteer->institute : old('institute') }}">
                                            @if ($errors->has('institute'))
                                                <span class="text-danger">{{ $errors->first('institute') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Please enter your phone number" value="{{ isset($volunteer) ? $volunteer->phone : old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Please enter your email address" value="{{ isset($volunteer) ? $volunteer->email : old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="street">Street Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="street" id="street" placeholder="Please enter your street address" value="{{ isset($volunteer) ? $volunteer->street : old('street') }}">
                                            @if ($errors->has('street'))
                                                <span class="text-danger">{{ $errors->first('street') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="city">City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="Please enter your city" value="{{ isset($volunteer) ? $volunteer->city : old('city') }}">
                                            @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="state">State <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="state" id="state" placeholder="Please enter your state" value="{{ isset($volunteer) ? $volunteer->state : old('state') }}">
                                            @if ($errors->has('state'))
                                                <span class="text-danger">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="post_code">Postal Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="post_code" id="post_code" placeholder="Please enter your postal code" value="{{ isset($volunteer) ? $volunteer->post_code : old('post_code') }}">
                                            @if ($errors->has('post_code'))
                                                <span class="text-danger">{{ $errors->first('post_code') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Select Country <span class="text-danger">*</span></label>
                                    <select name="country_id" class="form-select">
                                        <option value="">Please select any country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @if(isset($volunteer) && $country->id == $volunteer->country_id) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>

                                @isset($volunteer)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $volunteer->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($volunteer) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($errors->has('photo'))
                                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="skills">Skills</label>
                                    <select name="skills[]" id="skills" placeholder="Please enter keywords" class="form-select select2_tags" multiple="multiple">
                                        @isset($volunteer->skills)
                                            @foreach ($volunteer->skills as $skill)
                                                <option value="{{ $skill }}" selected>{{ $skill }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @if ($errors->has('skills'))
                                        <span class="text-danger">{{ $errors->first('skills') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="experiences">Experiences</label>
                                    <textarea class="form-control" name="experiences" id="experiences" placeholder="Please enter your experiences">{{ isset($volunteer) ? $volunteer->experiences : old('experiences') }}</textarea>
                                    @if ($errors->has('experiences'))
                                        <span class="text-danger">{{ $errors->first('experiences') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="bring_change">Bring Change</label>
                                    <textarea class="form-control" name="bring_change" id="bring_change" placeholder="What change will you bring to our organization?">{{ isset($volunteer) ? $volunteer->bring_change : old('bring_change') }}</textarea>
                                    @if ($errors->has('bring_change'))
                                        <span class="text-danger">{{ $errors->first('bring_change') }}</span>
                                    @endif
                                </div>   
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($volunteer) ? 'Update' : 'Submit' }}</button>
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