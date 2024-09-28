@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Testimonials</h1>
            <div>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/' . $testimonial->photo) }}" alt="" class="w_200">
                                            </td>
                                            <td>
                                                {{ $testimonial->name }}
                                            </td>
                                            <td>
                                                {{ $testimonial->designation }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.changeStatus', $testimonial->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $testimonial->id }}" value="{{ $testimonial->is_active }}">
                                                    @if ($testimonial->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $testimonial->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $testimonial->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.testimonials.edit',$testimonial->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $testimonial->id }})"><i class="fas fa-trash"></i></button>
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