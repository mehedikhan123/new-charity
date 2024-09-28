@extends('admin.layouts.app')

@section('page-title', isset($videoCategory) ? 'Edit Video Category' : 'Create Video Category')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($videoCategory) ? 'Edit' : 'Create' }} Video Category</h1>
            <div>
                <a href="{{ route('admin.gallery.video-category.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($videoCategory) ? route('admin.gallery.video-category.update', $videoCategory->id) : route('admin.gallery.video-category.store') }}" method="post">
                                @csrf
                                @isset($videoCategory)
                                    @method('put')
                                @endisset
                                <div class="form-group mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Please enter category name" value="{{ isset($videoCategory) ? $videoCategory->name : old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($videoCategory->id) ? 'Update' : 'Submit' }}</button>
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