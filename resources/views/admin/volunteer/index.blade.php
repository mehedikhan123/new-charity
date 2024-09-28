@extends('admin.layouts.app')

{{-- @section('page-title', 'Volunteer List') --}}

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Volunteers</h1>
            <div>
                <a href="{{ route('admin.volunteers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Age</th>
                                            <th>Occupation</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($volunteers as $volunteer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$volunteer->photo) }}" alt="" class="w_100">
                                            </td>
                                            <td>
                                                {{ ucfirst($volunteer->title) }} {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                                            </td>
                                            <td>
                                                {{ $volunteer->age }}
                                            </td>
                                            <td>
                                                {{ $volunteer->occupation }}
                                            </td>
                                            <td>
                                                {{ $volunteer->phone }}
                                            </td>
                                            <td>
                                                {{ $volunteer->email }}
                                            </td>
                                            <td>
                                                {{ $volunteer->street }}, {{ $volunteer->city }}, {{ $volunteer->state }} - {{ $volunteer->post_code }}, {{ $volunteer->country->name }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $volunteer->id }}" action="{{ route('admin.volunteers.changeStatus', $volunteer->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $volunteer->id }}" value="{{ $volunteer->is_active }}">
                                                    @if ($volunteer->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $volunteer->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $volunteer->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>    
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.volunteers.edit', $volunteer->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $volunteer->id }}" action="{{ route('admin.volunteers.destroy', $volunteer->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $volunteer->id }})"><i class="fas fa-trash"></i></button>
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