@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Services</h1>
            <div>
                <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Icon</th>
                                            <th>Heading</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facilities as $facility)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <i class="{{ $facility->icon }}" style="font-size:30px;"></i>
                                            </td>
                                            <td>
                                                {{ $facility->heading }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $facility->id }}" action="{{ route('admin.facilities.changeStatus', $facility->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $facility->id }}" value="{{ $facility->is_active }}">
                                                    @if ($facility->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $facility->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $facility->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.facilities.edit',$facility->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $facility->id }}" action="{{ route('admin.facilities.destroy', $facility->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $facility->id }})"><i class="fas fa-trash"></i></button>
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