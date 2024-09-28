@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($cause) ? 'Edit' : 'Create' }} Cause</h1>
            <div>
                <a href="{{ route('admin.causes.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($cause) ? route('admin.causes.update', $cause->slug) : route('admin.causes.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($cause)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter name" value="{{ isset($cause) ? $cause->name : old('name') }}">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="goal">Goal <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="goal" id="goal" placeholder="Please enter goal" value="{{ isset($cause) ? $cause->goal : old('goal') }}">
                                            @if ($errors->has('goal'))
                                                <span class="text-danger">{{ $errors->first('goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="short_description">Short Description <span class="text-danger">*</span></label>
                                    <textarea name="short_description" class="form-control h_100" cols="30" rows="10" id="short_description" placeholder="Please enter short description">{{ isset($cause) ? $cause->short_description : old('short_description') }}</textarea>
                                    @if ($errors->has('short_description'))
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10" id="description" placeholder="Please enter description">{{ isset($cause) ? $cause->description : old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                @isset($cause)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $cause->featured_photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($cause) ? 'Change Photo' : 'Photo <span class="text-danger"><span class="text-danger">*</span></span>' !!}</label>
                                        <div>
                                            <input type="file" name="featured_photo" class="form-control">
                                            @if ($errors->has('featured_photo'))
                                                <span class="text-danger">{{ $errors->first('featured_photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Is Featured? <span class="text-danger">*</span></label>
                                            <select name="is_featured" class="form-select">
                                                <option value="yes" @if(isset($cause->is_featured) && $cause->is_featured == 'yes') selected @endif>Yes</option>
                                                <option value="no" @if(isset($cause->is_featured) &&$cause->is_featured == 'no') selected @endif>No</option>
                                            </select>
                                            @if ($errors->has('is_featured'))
                                                <span class="text-danger">{{ $errors->first('is_featured') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($cause) ? 'Update' : 'Submit' }}</button>
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