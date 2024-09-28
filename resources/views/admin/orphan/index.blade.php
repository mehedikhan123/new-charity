@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Orphans</h1>
            <div>
                <a href="{{ route('admin.orphans.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                            <th>Economic Status</th>
                                            <th>Support type</th>
                                            <th>Address</th>
                                            <th>Reported by</th>
                                            <th>Current Status</th>
                                            <th>Select Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orphans as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$item->photo) }}" alt="" class="w_150">
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->age }}
                                            </td>
                                            <td>
                                                {{ $item->economic_status }}
                                            </td>
                                            <td>
                                                {{ $item->support_type }}
                                            </td>
                                            <td>
                                                {{ $item->village_city }}, {{ $item->upazilaName->name }}, {{ $item->districtName->name }}, {{ $item->divisionName->name }}
                                            </td>
                                            <td>
                                                @if ($item->volunteer)
                                                    {{ $item->volunteer->first_name }} {{ $item->volunteer->last_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status === 'pending')
                                                    <span class="text-warning">{{ ucfirst($item->status) }}</span>
                                                @elseif ($item->status === 'approved')
                                                    <span class="text-success">{{ ucfirst($item->status) }}</span>
                                                @elseif( $item->status === 'declined' )
                                                    <span class="text-danger">{{ ucfirst($item->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($item) && $item->status == 'pending')
                                                    <form action="{{ route('admin.orphans.changeStatus', $item->id) }}" method="post" style="display: inline">
                                                        @csrf
                                                        @method('patch')
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="">Select status</option>
                                                            <option value="pending" @if($item->status == 'pending') selected @endif>Pending</option>
                                                            <option value="approved" @if($item->status == 'approved') selected @endif>Approved</option>
                                                            <option value="declined" @if($item->status == 'declined') selected @endif>Declined</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                    @else 
                                                        <span>N/A</span>
                                                @endif
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.orphans.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.orphans.destroy', $item->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $item->id }})"><i class="fas fa-trash"></i></button>
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
