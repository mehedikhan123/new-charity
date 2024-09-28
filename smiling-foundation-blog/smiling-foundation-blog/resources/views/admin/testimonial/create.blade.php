@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($testimonial) ? 'Edit' : 'Create' }} Testimonial</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($testimonial)
                                    @method('put')
                                @endisset
                                <div class="form-group mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Please enter name" value="{{ isset($testimonial) ? $testimonial->name : old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="designation">Designation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="designation" id="designation" placeholder="Please enter designation" value="{{ isset($testimonial) ? $testimonial->designation : old('designation') }}">

                                    @if ($errors->has('designation'))
                                        <span class="text-danger">{{ $errors->first('designation') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <textarea name="comment" id="comment" placeholder="Please enter comment" class="form-control editor" cols="30" rows="10">{{ isset($testimonial) ? $testimonial->comment : old('comment') }}</textarea>

                                    @if ($errors->has('comment'))
                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                    @endif
                                </div>
                                
                                @isset($testimonial)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $testimonial->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($testimonial) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($errors->has('photo'))
                                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($testimonial) ? 'Update' : 'Submit' }}</button>
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