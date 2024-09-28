@extends('admin.layouts.app')

@section('page-title', isset($photoCategory) ? 'Edit Photo Category' : 'Create Photo Category')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($photoCategory) ? 'Edit' : 'Create' }} Photo Category</h1>
            <div>
                <a href="{{ route('admin.gallery.photo-category.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($photoCategory) ? route('admin.gallery.photo-category.update', $photoCategory->id) : route('admin.gallery.photo-category.store') }}" method="post">
                                @csrf
                                @isset($photoCategory)
                                    @method('put')
                                @endisset
                                <div class="form-group mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Please enter category name" value="{{ isset($photoCategory) ? $photoCategory->name : old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($photoCategory->id) ? 'Update' : 'Submit' }}</button>
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