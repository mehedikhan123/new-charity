@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Appeal ({{ $appeal->name }}) Photos</h1>
            <div>
                <a href="{{ route('admin.appeals.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Appeals</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($appeal, $appealPhoto) ? route('admin.appeals.photos.update', [$appeal->slug, $appealPhoto->id]) : route('admin.appeals.photos.store', $appeal->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($appeal, $appealPhoto))
                                    @method('put')
                                @endif
                                <input type="hidden" name="appeal_id" value="{{ $appeal->id }}">
                                {{-- <div class="form-group mb-3">
                                    <label for="photo">Select Photo <span class="text-danger">*</span></label>
                                    <div>
                                        <input type="file" name="photo" class="form-control" id="photo">
                                        @if ($errors->has('photo'))
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                @isset($appealPhoto)
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $appealPhoto->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset
                                <div class="form-group mb-3">
                                    <label>{!! isset($appealPhoto) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                    <div>
                                        @if(isset($appealPhoto))
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
                                    <button type="submit" class="btn btn-primary">{{ isset($appeal, $appealPhoto) ? 'Update' : 'Submit' }}</button>
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
                                        @foreach ($appealPhotos as $appealPhoto)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/photo/'.$appealPhoto->photo) }}" alt="" class="w_150">
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin.appeals.photos',[$appeal->slug, $appealPhoto->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $appeal->id }}" action="{{ route('admin.appeals.photos.destroy', [$appeal->slug, $appealPhoto->id]) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $appeal->id }})"><i class="fas fa-trash"></i></button>
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