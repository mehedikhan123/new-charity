@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($feature) ? 'Edit' : 'Create' }} Feature</h1>
            <div>
                <a href="{{ route('admin.features.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($feature) ? route('admin.features.update', $feature->id) : route('admin.features.store') }}" method="post">
                                @csrf
                                @isset($feature)
                                    @method('put')
                                @endisset
                                <div class="form-group mb-3">
                                    <label for="heading">Heading <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="heading" id="heading" placeholder="Please enter heading" value="{{ isset($feature) ? $feature->heading : old('heading') }}">

                                    @if ($errors->has('heading'))
                                        <span class="text-danger">{{ $errors->first('heading') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="counter">Counter</label>
                                    <input type="number" class="form-control" name="counter" id="counter" placeholder="Please enter counter" value="{{ isset($feature) ? $feature->counter : old('counter') }}">

                                    @if ($errors->has('counter'))
                                        <span class="text-danger">{{ $errors->first('counter') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="text">Text <span class="text-danger">*</span></label>
                                    <textarea name="text" id="text" placeholder="Please enter text" class="form-control editor" cols="30" rows="10">{{ isset($feature) ? $feature->text : old('text') }}</textarea>

                                    @if ($errors->has('text'))
                                        <span class="text-danger">{{ $errors->first('text') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="button_text">Button text</label>
                                    <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Please enter button text" value="{{ isset($feature) ? $feature->button_text : old('button_text') }}">

                                    @if ($errors->has('button_text'))
                                        <span class="text-danger">{{ $errors->first('button_text') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="button_link">Button link</label>
                                    <input type="text" class="form-control" name="button_link" id="button_link" placeholder="Please enter button link" value="{{ isset($feature) ? $feature->button_link : old('button_link') }}">

                                    @if ($errors->has('button_link'))
                                        <span class="text-danger">{{ $errors->first('button_link') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($feature) ? 'Update' : 'Submit' }}</button>
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