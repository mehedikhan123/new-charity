@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Program ({{ $program->name }}) Photos</h1>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Programs</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($program, $programPhoto) ? route('admin.programs.photos.update', [$program->slug, $programPhoto->id]) : route('admin.programs.photos.store', $program->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($program, $programPhoto))
                                    @method('put')
                                @endif
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                {{-- <div class="form-group mb-3">
                                    <label for="photo">Select Photo <span class="text-danger">*</span></label>
                                    <div>
                                        <input type="file" name="photo" class="form-control" id="photo">
                                        @if ($errors->has('photo'))
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                @isset($programPhoto)
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $programPhoto->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset
                                <div class="form-group mb-3">
                                    <label>{!! isset($programPhoto) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                    <div>
                                        @if(isset($programPhoto))
                                            <input type="file" name="photo" class="form-control" />
                                        @else
                                            <input type="file" name="photo[]" multiple class="form-control" required />
                                        @endif
                                        @if ($errors->has('photo') || $errors->has('photo.*'))
                                            <span class="text-danger">
                                                {{ $errors->first('photo') ?: $errors->first('photo.*') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($program, $programPhoto) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($programPhotos as $programPhoto)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$programPhoto->photo) }}" alt="" class="w_150">
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.programs.photos',[$program->slug, $programPhoto->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $program->id }}" action="{{ route('admin.programs.photos.destroy', [$program->slug, $programPhoto->id]) }}" method="post" style="display: inline;">
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