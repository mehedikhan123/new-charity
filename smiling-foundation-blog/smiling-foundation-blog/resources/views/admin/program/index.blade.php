@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Programs</h1>
            <div>
                <a href="{{ route('admin.programs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Type</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Price</th>
                                            <th>Total Seat</th>
                                            <th>Booked Seat</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($programs as $program)
                                        @php
                                            $formattedStartDate = \Carbon\Carbon::parse($program->start_date_time)->format('d F, Y h:i A');
                                            $formattedEndDate = \Carbon\Carbon::parse($program->end_date_time)->format('d F, Y h:i A');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$program->photo) }}" alt="" class="w_150">
                                            </td>
                                            <td>
                                                {{ $program->name }}
                                            </td>
                                            <td>
                                                {{ ucfirst($program->type) }}
                                            </td>
                                            <td>
                                                {{ $formattedStartDate }}
                                            </td>
                                            <td>
                                                {{ $formattedEndDate }}
                                            </td>
                                            <td>
                                                {{ $program->price }}
                                            </td>
                                            <td>
                                                {{ $program->total_seat }}
                                            </td>
                                            <td>
                                                {{ $program->booked_seat }}
                                            </td>
                                            <td>
                                                <form id="change-status-form-{{ $program->id }}" action="{{ route('admin.programs.changeStatus', $program->slug) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="is_active" id="is_active-{{ $program->id }}" value="{{ $program->is_active }}">
                                                    @if ($program->is_active)
                                                        <button type="button" class="btn btn-success" onClick="confirmChangeStatus({{ $program->id }})">
                                                            Active
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" onClick="confirmChangeStatus({{ $program->id }})">
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.programs.photos', $program->slug) }}" class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                <a href="{{ route('admin.programs.videos', $program->slug) }}" class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                                <a href="{{ route('admin.programs.tickets',$program->slug) }}" class="btn btn-warning btn-sm w_100_p">Tickets</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.programs.edit',$program->slug) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $program->id }}" action="{{ route('admin.programs.destroy', $program->slug) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $program->id }})"><i class="fas fa-trash"></i></button>
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