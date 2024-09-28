@extends('admin.layouts.app')

{{-- @section('page-title', isset($photo) ? 'Edit Photo' : 'Create Photo') --}}

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($photo) ? 'Edit' : 'Create' }} Photo</h1>
            <div>
                <a href="{{ route('admin.gallery.photo.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($photo) ? route('admin.gallery.photo.update', $photo->id) : route('admin.gallery.photo.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($photo)
                                    @method('put')
                                @endisset

                                @isset($photo)
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $photo->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset
                                <div class="form-group mb-3">
                                    <label>{!! isset($photo) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                    <div>
                                        @if(isset($photo))
                                            <input type="file" name="photo" class="form-control" />
                                        @else
                                            <input type="file" name="photo[]" multiple class="form-control" />
                                        @endif
                                        @if ($errors->has('photo') || $errors->has('photo.*'))
                                            <span class="text-danger">
                                                {{ $errors->first('photo') ?: $errors->first('photo.*') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Select Category <span class="text-danger">*</span></label>
                                    <select name="photo_category_id" class="form-select">
                                        <option value="">Please select any category</option>
                                        @foreach ($photoCategories as $photoCategory)
                                            <option value="{{ $photoCategory->id }}" @if(isset($photo) && $photoCategory->id == $photo->photo_category_id) selected @endif>{{ $photoCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('photo_category_id'))
                                        <span class="text-danger">{{ $errors->first('photo_category_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($photo) ? 'Update' : 'Submit' }}</button>
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