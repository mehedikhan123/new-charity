@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($counter) ? 'Edit' : 'Add' }} Counter</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($counter) ? route('admin.counters.update', $counter->id) : route('admin.counters.store') }}" method="post">
                                @csrf
                                @isset($counter)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 1 - Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter1_number" value="{{ isset($counter) ? $counter->counter1_number : old('counter1_number') }}" autocomplete="off">
                                            @if ($errors->has('counter1_number'))
                                                <span class="text-danger">{{ $errors->first('counter1_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 1 - Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter1_name" value="{{ isset($counter) ? $counter->counter1_name : old('counter1_name') }}" autocomplete="off">
                                            @if ($errors->has('counter1_name'))
                                                <span class="text-danger">{{ $errors->first('counter1_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 2 - Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter2_number" value="{{ isset($counter) ? $counter->counter2_number : old('counter2_number') }}" autocomplete="off">
                                            @if ($errors->has('counter2_number'))
                                                <span class="text-danger">{{ $errors->first('counter2_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 2 - Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter2_name" value="{{ isset($counter) ? $counter->counter2_name : old('counter2_name') }}" autocomplete="off">
                                            @if ($errors->has('counter2_name'))
                                                <span class="text-danger">{{ $errors->first('counter2_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 3 - Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter3_number" value="{{ isset($counter) ? $counter->counter3_number : old('counter3_number') }}" autocomplete="off">
                                            @if ($errors->has('counter3_number'))
                                                <span class="text-danger">{{ $errors->first('counter3_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 3 - Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter3_name" value="{{ isset($counter) ? $counter->counter3_name : old('counter3_name') }}" autocomplete="off">
                                            @if ($errors->has('counter3_name'))
                                                <span class="text-danger">{{ $errors->first('counter3_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 4 - Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter4_number" value="{{ isset($counter) ? $counter->counter4_number : old('counter4_number') }}" autocomplete="off">
                                            @if ($errors->has('counter4_number'))
                                                <span class="text-danger">{{ $errors->first('counter4_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 4 - Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="counter4_name" value="{{ isset($counter) ? $counter->counter4_name : old('counter4_name') }}" autocomplete="off">
                                            @if ($errors->has('counter4_name'))
                                                <span class="text-danger">{{ $errors->first('counter4_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select name="status" class="form-select">
                                                <option value="active" @if(isset($counter) && $counter->status == 'active') selected @endif>Active</option>
                                                <option value="inactive" @if(isset($counter) && $counter->status == 'inactive') selected @endif>Inactive</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($counter) ? 'Update' : 'Submit' }}</button>
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