@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Create News</h1>
            <div>
                <a href="{{ route('admin.admin_news_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.admin_news_create_submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="photo">Photo <span class="text-danger">*</span></label>
                                    <div>
                                        <input type="file" name="photo" id="photo"> 
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Please enter title">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" placeholder="Please enter description" class="form-control editor" cols="30" rows="10"></textarea>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>Send Email to Subscribers?</label>
                                            <select name="email_send" class="form-select">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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