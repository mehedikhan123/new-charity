@extends('admin.layouts.app')

@section('page-title', 'Video List')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Videos</h1>
            <div>
                <a href="{{ route('admin.gallery.video.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Video Preview</th>
                                            <th>YouTube Video ID</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <iframe class="i1" width="200" height="100" src="https://www.youtube.com/embed/{{ $video->video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </td>
                                            <td>
                                                {{ $video->video }}
                                            </td>
                                            <td>
                                                {{ $video->videoCategory->name }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $video->id }}" action="{{ route('admin.gallery.video.changeStatus', $video->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $video->id }}" value="{{ $video->is_active }}">
                                                    @if ($video->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $video->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $video->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.gallery.video.edit', $video->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $video->id }}" action="{{ route('admin.gallery.video.destroy', $video->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $video->id }})"><i class="fas fa-trash"></i></button>
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