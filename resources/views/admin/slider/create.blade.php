@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($slider) ? 'Edit' : 'Create' }} Slider</h1>
            <div>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($slider) ? route('admin.sliders.update', $slider->id) : route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($slider)
                                    @method('put')
                                @endisset
                                <div class="form-group mb-3">
                                    <label for="heading">Heading <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="heading" id="heading" placeholder="Please enter heading" value="{{ isset($slider) ? $slider->heading : old('heading') }}">

                                    @if ($errors->has('heading'))
                                        <span class="text-danger">{{ $errors->first('heading') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="text">Text <span class="text-danger">*</span></label>
                                    <textarea name="text" id="text" placeholder="Please enter text" class="form-control editor" cols="30" rows="10">{{ isset($slider) ? $slider->text : old('text') }}</textarea>

                                    @if ($errors->has('text'))
                                        <span class="text-danger">{{ $errors->first('text') }}</span>
                                    @endif
                                </div>
                                @isset($slider)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $slider->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($slider) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($errors->has('photo'))
                                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($slider) ? 'Update' : 'Submit' }}</button>
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