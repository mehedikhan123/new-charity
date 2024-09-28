@extends('admin.layouts.app')

{{-- @section('page-title', isset($video) ? 'Edit Video' : 'Create Video') --}}

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($video) ? 'Edit' : 'Create' }} Video</h1>
            <div>
                <a href="{{ route('admin.gallery.video.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($video) ? route('admin.gallery.video.update', $video->id) : route('admin.gallery.video.store') }}" method="post">
                                @csrf
                                @isset($video)
                                    @method('put')
                                @endisset

                                <div class="form-group mb-3">
                                    <label for="video">YouTube Video IDs <span class="text-danger">*</span></label>
                                    <div id="video-rows">
                                        @if(old('video')) 
                                            @foreach(old('video') as $key => $vid)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="video[]" id="video" placeholder="Please enter your YouTube video ID" value="{{ $vid }}">
                                                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                </div>
                                            @endforeach
                                        @elseif(isset($video) && $video->video)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="video" id="video" placeholder="Please enter YouTube video ID" value="{{ $video->video }}">
                                            </div>
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="video[]" id="video" placeholder="Please enter YouTube video ID" value="">
                                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @if(!isset($video) || !$video->video)
                                    @if ($errors->has('video') || $errors->has('video.*'))
                                        <div class="text-danger">
                                            {{ $errors->first('video') ?: $errors->first('video.*') }}
                                        </div>
                                    @endif
                                    
                                        <button type="button" id="add-video-row" class="btn btn-success mt-2">Add More</button>
                                    @endif                                    
                                </div>
                                <div class="form-group mb-3">
                                    <label>Select Category <span class="text-danger">*</span></label>
                                    <select name="video_category_id" class="form-select">
                                        <option value="">Please select any category</option>
                                        @foreach ($videoCategories as $videoCategory)
                                            <option value="{{ $videoCategory->id }}" @if(isset($video) && $videoCategory->id == $video->video_category_id) selected @endif>{{ $videoCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('video_category_id'))
                                        <span class="text-danger">{{ $errors->first('video_category_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($video) ? 'Update' : 'Submit' }}</button>
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

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Add new row
    document.getElementById('add-video-row').addEventListener('click', function () {
        const videoRow = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="video[]" placeholder="Please enter YouTube video ID">
                <button type="button" class="btn btn-danger remove-row">Remove</button>
            </div>
        `;
        document.getElementById('video-rows').insertAdjacentHTML('beforeend', videoRow);
    });

    // Remove row
    document.getElementById('video-rows').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-row')) {
            event.target.closest('.input-group').remove();
        }
    });
});
</script>
@endpush