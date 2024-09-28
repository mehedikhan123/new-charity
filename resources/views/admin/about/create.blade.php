@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($about) ? 'Edit' : 'Create' }} About Section</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($about) ? route('admin.about.update', $about->id) : route('admin.about.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($about)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="heading">Heading <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="heading" id="heading" placeholder="Please enter heading" value="{{ isset($about) ? $about->heading : old('heading') }}">
        
                                            @if ($errors->has('heading'))
                                                <span class="text-danger">{{ $errors->first('heading') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- <div class="form-group mb-3">
                                            <label for="sub_heading">Sub Heading</label>
                                            <input type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="Please enter sub heading" value="{{ isset($about) ? $about->sub_heading : old('sub_heading') }}">
        
                                            @if ($errors->has('sub_heading'))
                                                <span class="text-danger">{{ $errors->first('sub_heading') }}</span>
                                            @endif
                                        </div> --}}
                                        <div class="form-group mb-3">
                                            <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-select">
                                                <option value="">Please select any category</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}" @if(isset($about->category_id) && $item->id == $about->category_id) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group mb-3">
                                    <label for="text">Text <span class="text-danger">*</span></label>
                                    <textarea name="text" id="text" placeholder="Please enter text" class="form-control editor" cols="30" rows="10">{{ isset($about) ? $about->text : old('text') }}</textarea>

                                    @if ($errors->has('text'))
                                        <span class="text-danger">{{ $errors->first('text') }}</span>
                                    @endif
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="button_text">Button text</label>
                                            <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Please enter button text" value="{{ isset($about) ? $about->button_text : old('button_text') }}">
        
                                            @if ($errors->has('button_text'))
                                                <span class="text-danger">{{ $errors->first('button_text') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="button_link">Button link</label>
                                            <input type="text" class="form-control" name="button_link" id="button_link" placeholder="Please enter button link" value="{{ isset($about) ? $about->button_link : old('button_link') }}">
        
                                            @if ($errors->has('button_link'))
                                                <span class="text-danger">{{ $errors->first('button_link') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="video_id">Video ID</label>
                                            <input type="text" class="form-control" name="video_id" id="video_id" placeholder="Please enter video ID" value="{{ isset($about) ? $about->video_id : old('video_id') }}" autocomplete="off">

                                            @if ($errors->has('video_id'))
                                                <span class="text-danger">{{ $errors->first('video_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                
                                @isset($about)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $about->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($about) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($errors->has('photo'))
                                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($about) ? 'Update' : 'Submit' }}</button>
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