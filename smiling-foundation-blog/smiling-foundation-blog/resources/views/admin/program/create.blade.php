@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($program) ? 'Edit' : 'Create' }} Program</h1>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($program) ? route('admin.programs.update', $program->slug) : route('admin.programs.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($program)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter name" value="{{ isset($program) ? $program->name : old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="type">Type <span class="text-danger">*</span></label>
                                            <select name="type" class="form-select">
                                                <option value="">Please select any type</option>
                                                @foreach ($programTypes as $programType)
                                                    <option value="{{ $programType['value'] }}" @if(isset($program) && $program->type == $programType['value']) selected @endif>{{ $programType['text'] }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="text-danger">{{ $errors->first('type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="start_date_time">Start Date <span class="text-danger">*</span></label>
                                            <input id="start_date_time" type="datetime-local" class="form-control" name="start_date_time" id="start_date_time" placeholder="Please enter start date-time" value="{{ isset($program) ? $program->start_date_time : old('start_date_time') }}">
                                            @if ($errors->has('start_date_time'))
                                                <span class="text-danger">{{ $errors->first('start_date_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="end_date_time">End Date <span class="text-danger">*</span></label>
                                            <input id="end_date_time" type="datetime-local" class="form-control" name="end_date_time" id="end_date_time" placeholder="Please enter end date-time" value="{{ isset($program) ? $program->end_date_time : old('end_date_time') }}">
                                            @if ($errors->has('end_date_time'))
                                                <span class="text-danger">{{ $errors->first('end_date_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="location">Location <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="location" id="location" placeholder="Please enter location" value="{{ isset($program) ? $program->location : old('location') }}">
                                            @if ($errors->has('location'))
                                                <span class="text-danger">{{ $errors->first('location') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" id="price" placeholder="Please enter price" value="{{ isset($program) ? $program->price : old('price') }}">
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="total_seat">Total Seat</label>
                                            <input type="text" class="form-control" name="total_seat" id="total_seat" placeholder="Please enter total seat" value="{{ isset($program) ? $program->total_seat : old('total_seat') }}">
                                            @if ($errors->has('total_seat'))
                                                <span class="text-danger">{{ $errors->first('total_seat') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="map">Map</label>
                                            <textarea name="map" class="form-control h_100" id="map" placeholder="Please enter map" cols="30" rows="10">{{ isset($program) ? $program->map : old('map') }}</textarea>
                                            @if ($errors->has('map'))
                                                <span class="text-danger">{{ $errors->first('map') }}</span>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="form-group mb-3">
                                        <label for="short_description">Short Description <span class="text-danger">*</span></label>
                                        <textarea name="short_description" class="form-control h_100" cols="30" rows="10" id="short_description" placeholder="Please enter short description">{{ isset($program) ? $program->short_description : old('short_description') }}</textarea>
                                        @if ($errors->has('short_description'))
                                            <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10" id="description" placeholder="Please enter description">{{ isset($program) ? $program->description : old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>

                                @isset($program)
                                    @method('put')
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/' . $program->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{!! isset($program) ? 'Change Photo' : 'Photo <span class="text-danger">*</span>' !!}</label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($errors->has('photo'))
                                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($program) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection