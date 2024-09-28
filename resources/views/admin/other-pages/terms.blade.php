@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Edit Terms Page Content</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.terms.update') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Content <span class="text-danger">*</span></label>
                                    <textarea name="terms_content" class="form-control editor" cols="30" rows="10">{{ $terms->terms_content }}</textarea>
                                    @if ($errors->has('terms_content'))
                                        <span class="text-danger">{{ $errors->first('terms_content') }}</span>
                                    @endif
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