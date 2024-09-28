@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>About Categories</h1>
            <div>
                <a href="{{ route('admin.about-category.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aboutCategories as $aboutCategory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $aboutCategory->name }}
                                            </td>
                                            <td>
                                                {{ $aboutCategory->slug }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $aboutCategory->id }}" action="{{ route('admin.about-category.changeStatus', $aboutCategory->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $aboutCategory->id }}" value="{{ $aboutCategory->is_active }}">
                                                    @if ($aboutCategory->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $aboutCategory->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $aboutCategory->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.about-category.edit',$aboutCategory->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $aboutCategory->id }}" action="{{ route('admin.about-category.destroy', $aboutCategory->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $aboutCategory->id }})"><i class="fas fa-trash"></i></button>
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