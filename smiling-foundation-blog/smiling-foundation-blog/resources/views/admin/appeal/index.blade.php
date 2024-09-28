@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Appeals</h1>
            <div>
                <a href="{{ route('admin.appeals.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appeals as $appeal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/' . $appeal->photo) }}" alt="" class="w_200">
                                            </td>
                                            <td>
                                                {{ $appeal->name }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $appeal->id }}" action="{{ route('admin.appeals.changeStatus', $appeal->slug) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $appeal->id }}" value="{{ $appeal->is_active }}">
                                                    @if ($appeal->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $appeal->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $appeal->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.appeals.photos', $appeal->slug) }}" class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                <a href="{{ route('admin.appeals.videos', $appeal->slug) }}" class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.appeals.edit', $appeal->slug) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $appeal->id }}" action="{{ route('admin.appeals.destroy', $appeal->slug) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $appeal->id }})"><i class="fas fa-trash"></i></button>
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