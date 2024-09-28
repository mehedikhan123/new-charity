@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Edit News</h1>
            <div>
                <a href="{{ route('admin.admin_news_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.admin_news_edit_submit',$news->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Existing Photo</label>
                                    <div>
                                        <img src="{{ asset('storage/uploads/photo/'.$news->photo) }}" alt="" class="w_200">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="photo">Change Photo</label>
                                    <div>
                                        <input type="file" name="photo" id="photo">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" placeholder="Please enter title" class="form-control" value="{{ $news->title }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" placeholder="Please enter description" class="form-control editor" cols="30" rows="10">{{ $news->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
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