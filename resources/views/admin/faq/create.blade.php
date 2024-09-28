@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($faq) ? 'Edit' : 'Create' }} FAQ</h1>
            <div>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="post">
                                @csrf
                                @isset($faq)
                                    @method('put')
                                @endisset
                                <div class="form-group mb-3">
                                    <label for="question">Question <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="question" id="question" placeholder="Please enter question" value="{{ isset($faq) ? $faq->question : old('question') }}">

                                    @if ($errors->has('question'))
                                        <span class="text-danger">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="answer">Answer <span class="text-danger">*</span></label>
                                    <textarea name="answer" id="answer" placeholder="Please enter answer" class="form-control editor" cols="30" rows="10">{{ isset($faq) ? $faq->answer : old('answer') }}</textarea>

                                    @if ($errors->has('answer'))
                                        <span class="text-danger">{{ $errors->first('answer') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($faq) ? 'Update' : 'Submit' }}</button>
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