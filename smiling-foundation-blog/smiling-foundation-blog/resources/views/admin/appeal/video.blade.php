@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Appeal ({{ $appeal->name }}) Videos</h1>
            <div>
                <a href="{{ route('admin.appeals.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Appeals</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($appeal, $appealVideo) ? route('admin.appeals.videos.update', [$appeal->slug, $appealVideo->id]) : route('admin.appeals.videos.store', $appeal->slug) }}" method="post">
                                @csrf
                                @if(isset($appeal, $appealVideo))
                                    @method('put')
                                @endif
                                <input type="hidden" name="appeal_id" value="{{ $appeal->id }}">
                                <div class="form-group mb-3">
                                    <label for="video">YouTube Video IDs <span class="text-danger">*</span></label>
                                    <div id="video-rows">
                                        @if(old('video')) 
                                            @foreach(old('video') as $key => $vid)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="video[]" id="video" placeholder="Please enter your YouTube video ID" value="{{ $vid }}" required>
                                                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                </div>
                                            @endforeach
                                        @elseif(isset($appealVideo) && $appealVideo->video)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="video" id="video" placeholder="Please enter YouTube video ID" value="{{ $appealVideo->video }}">
                                            </div>
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="video[]" id="video" placeholder="Please enter YouTube video ID" value="" required>
                                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @if(!isset($appealVideo) || !$appealVideo->video)
                                    @if ($errors->has('video') || $errors->has('video.*'))
                                        <div class="text-danger">
                                            {{ $errors->first('video') ?: $errors->first('video.*') }}
                                        </div>
                                    @endif
                                    
                                        <button type="button" id="add-video-row" class="btn btn-success mt-2">Add More</button>
                                    @endif                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($appeal, $appealVideo) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Video Preview</th>
                                            <th>Video Id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appealVideos as $appealVideo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <iframe class="i1" width="100%" height="auto" src="https://www.youtube.com/embed/{{ $appealVideo->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </td>
                                            <td>
                                                {{ $appealVideo->video }}
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.appeals.videos',[$appeal->slug, $appealVideo->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $appealVideo->id }}" action="{{ route('admin.appeals.videos.destroy', [$appeal->slug, $appealVideo->id]) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $appealVideo->id }})"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                <input type="text" class="form-control" name="video[]" placeholder="Please enter YouTube video ID" required>
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