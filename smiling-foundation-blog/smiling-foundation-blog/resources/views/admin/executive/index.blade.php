@extends('admin.layouts.app')

{{-- @section('page-title', 'Executive List') --}}

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Executives</h1>
            <div>
                <a href="{{ route('admin.executives.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($executives as $executive)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$executive->photo) }}" alt="" class="w_100">
                                            </td>
                                            <td>
                                                {{ $executive->name }}
                                            </td>
                                            <td>
                                                {{ $executive->designation }}
                                            </td>
                                            <td>
                                                {{ $executive->country->name }}
                                            </td>
                                            <td>
                                                {{ $executive->phone }}
                                            </td>
                                            <td>
                                                {{ $executive->email }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $executive->id }}" action="{{ route('admin.executives.changeStatus', $executive->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $executive->id }}" value="{{ $executive->is_active }}">
                                                    @if ($executive->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $executive->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $executive->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.executives.edit', $executive->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $executive->id }}" action="{{ route('admin.executives.destroy', $executive->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $executive->id }})"><i class="fas fa-trash"></i></button>
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
    <!-- Include SweetAlert2 via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include your custom JS file -->
    <script src="{{ asset('dist-admin/js/sweet-alert.js') }}"></script>
@endpush