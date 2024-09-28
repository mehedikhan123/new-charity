@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <h5>Edit Information</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.admin_edit_profile_submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-3">
                                        @if(Auth::guard('admin')->user()->photo != null)
                                            <img src="{{ asset('storage/uploads/photo/'.Auth::guard('admin')->user()->photo) }}" alt="" class="profile-photo w_100_p">
                                        @else
                                            <img src="{{ asset('uploads/default.png') }}" alt="" class="profile-photo w_100_p">
                                        @endif
                                        <input type="file" class="mt_10 form-control" name="photo">
                                        @if ($errors->has('photo'))
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter name" value="{{ Auth::guard('admin')->user()->name }}" autocomplete="off">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Please enter email address" value="{{ Auth::guard('admin')->user()->email }}" autocomplete="off">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h5>Change Password</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.admin_change_password_submit') }}" method="post">
                                @csrf
                                <div class="row d-flex align-items-center">
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Please enter password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Retype Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Please confirm password">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </div>
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