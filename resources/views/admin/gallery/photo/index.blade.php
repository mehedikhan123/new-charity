@extends('admin.layouts.app')

@section('page-title', 'Photo List')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Photos</h1>
            <div>
                <a href="{{ route('admin.gallery.photo.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Photo</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($photos as $photo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$photo->photo) }}" alt="" class="w_100">
                                            </td>
                                            <td>
                                                {{ $photo->photoCategory->name }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $photo->id }}" action="{{ route('admin.gallery.photo.changeStatus', $photo->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $photo->id }}" value="{{ $photo->is_active }}">
                                                    @if ($photo->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $photo->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $photo->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.gallery.photo.edit', $photo->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $photo->id }}" action="{{ route('admin.gallery.photo.destroy', $photo->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $photo->id }})"><i class="fas fa-trash"></i></button>
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