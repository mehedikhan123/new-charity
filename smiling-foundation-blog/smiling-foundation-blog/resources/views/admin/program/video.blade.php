@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Program ({{ $program->name }}) Videos</h1>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Programs</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($program, $programVideo) ? route('admin.programs.videos.update', [$program->slug, $programVideo->id]) : route('admin.programs.videos.store', $program->slug) }}" method="post">
                                @csrf
                                @if(isset($program, $programVideo))
                                    @method('put')
                                @endif
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <div class="form-group mb-3">
                                    <label for="video">YouTube Video IDs <span class="text-danger">*</span></label>
                                    <div id="video-rows">
                                        @if(old('video')) 
                                            @foreach(old('video') as $key => $vid)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="video[]" id="video" placeholder="Please enter your YouTube video ID" value="{{ $vid }}">
                                                    <button type="button" class="btn btn-danger remove-row" required>Remove</button>
                                                </div>
                                            @endforeach
                                        @elseif(isset($programVideo) && $programVideo->video)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="video" id="video" placeholder="Please enter YouTube video ID" value="{{ $programVideo->video }}">
                                            </div>
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="video[]" id="video" placeholder="Please enter YouTube video ID" value="" required>
                                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @if(!isset($programVideo) || !$programVideo->video)
                                    @if ($errors->has('video') || $errors->has('video.*'))
                                        <div class="text-danger">
                                            {{ $errors->first('video') ?: $errors->first('video.*') }}
                                        </div>
                                    @endif
                                    
                                        <button type="button" id="add-video-row" class="btn btn-success mt-2">Add More</button>
                                    @endif                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($program, $programVideo) ? 'Update' : 'Submit' }}</button>
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
                                        @foreach ($programVideos as $programVideo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <iframe class="i1" width="100%" height="auto" src="https://www.youtube.com/embed/{{ $programVideo->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </td>
                                            <td>
                                                {{ $programVideo->video }}
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.programs.videos',[$program->slug, $programVideo->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $programVideo->id }}" action="{{ route('admin.programs.videos.destroy', [$program->slug, $programVideo->id]) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $programVideo->id }})"><i class="fas fa-trash"></i></button>
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