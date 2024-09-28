@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Sliders</h1>
            <div>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Heading</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/' . $slider->photo) }}" alt="" class="w_200">
                                            </td>
                                            <td>
                                                {{ $slider->heading }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $slider->id }}" action="{{ route('admin.sliders.changeStatus', $slider->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $slider->id }}" value="{{ $slider->is_active }}">
                                                    @if ($slider->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $slider->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $slider->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.sliders.edit',$slider->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $slider->id }}" action="{{ route('admin.sliders.destroy', $slider->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $slider->id }})"><i class="fas fa-trash"></i></button>
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