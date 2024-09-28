@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Causes</h1>
            {{-- <div>
                <a href="{{ route('admin.causes.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
            </div> --}}
            <div>
                <a href="{{ route('admin.causes.donation', null) }}" class="btn btn-primary">Donations</a>
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
                                            <th>Goal</th>
                                            <th>Raised</th>
                                            <th>Is Featured?</th>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($causes as $cause)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$cause->featured_photo) }}" alt="" class="w_150">
                                            </td>
                                            <td>
                                                {{ $cause->name }}
                                            </td>
                                            <td>
                                                ${{ $cause->goal }}
                                            </td>
                                            <td>
                                                ${{ $cause->raised }}
                                            </td>
                                            <td>
                                                {{ ucfirst($cause->is_featured) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.causes.photos', $cause->slug) }}" class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                <a href="{{ route('admin.causes.videos', $cause->slug) }}" class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                                <a href="{{ route('admin.admin_cause_faq',$cause->id) }}" class="btn btn-info btn-sm w_100_p mb_5">FAQ</a>
                                                <a href="{{ route('admin.causes.donations',$cause->slug) }}" class="btn btn-warning btn-sm w_100_p">Donations</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.causes.edit', $cause->slug) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $cause->id }}" action="{{ route('admin.causes.destroy', $cause->slug) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $cause->id }})"><i class="fas fa-trash"></i></button>
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