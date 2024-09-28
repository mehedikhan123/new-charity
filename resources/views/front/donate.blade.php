@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ isset($global_banner->donate) ? asset('storage/uploads/photo/'.$global_banner->donate) : asset('storage/uploads/photo/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-container">
                    <h2>Donate</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cause.index') }}">Donate</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="my-5">
    <div class="container" style="width: 48.7vw;">
        <div class="row d-flex justify-content-center shadow p-4">
            <div class="col">
                <div>
                <h1 class="text-center text-primary fw-bolder">Donation Information</h1>
                <form action="{{ route('donation.payment') }}" method="post">
                    @csrf
                    @isset ($cause)
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                    @endisset
                    <div class="mt-3">
                        <h5>How much would you like to donate?</h5>
                        <div>
                            {{-- <h5>Select an Amount:</h5> --}}
                            <ul class="d-flex justify-content-start ps-0">
                                {{-- <li class="list-unstyled">
                                    <button type="button" class="btn btn-primary donation-button px-3" data-amount="10">$10</button>
                                </li> --}}
                                <li class="list-unstyled">
                                    <button type="button" class="btn donation-button btn-1" data-amount="25" style="width: 10vw;">$25</button>
                                </li>
                                <li class="list-unstyled ms-2">
                                    <button type="button" class="btn donation-button btn-2 selected ms-2" data-amount="50" style="width: 10vw;">$50</button>
                                </li>
                                <li class="list-unstyled ms-2">
                                    <button type="button" class="btn donation-button btn-3 ms-2" data-amount="100" style="width: 10vw;">$100</button>
                                </li>
                                <li class="list-unstyled ms-2">
                                    <button type="button" class="btn donation-button btn-4 ms-2" data-amount="" style="width: 10vw;">Custom</button>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input name="price" type="text" class="form-control" id="donation-amount">
                            </div>
                        </div>
                        {{-- <h5>Select Donation Type:</h5> --}}
                        <div>
                            <select name="donation_type" class="form-select">
                                <option value="">Select Donation Type</option>
                                <option value="one_time">One Time</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        @if ($errors->has('donation_type'))
                            <span class="text-danger">{{ $errors->first('donation_type') }}</span>
                        @endif
                        {{-- <h5 class="mt-3">Select Payment Method:</h5> --}}
                        <div class="mt-3">
                            <select name="payment_method" class="form-select">
                                <option value="">Select Payment Method</option>
                                <option value="paypal">PayPal</option>
                                <option value="stripe">Credit Card</option>
                            </select>
                        </div>
                        @if ($errors->has('payment_method'))
                            <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                        @endif
                        <h5 class="mt-4">Donor Information</h5>
                        <div class="">
                            {{-- <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Please enter your name">  --}}
                            <div class="form-group mb-2">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Please enter your name" value="{{ isset($volunteer) ? $volunteer->name : old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Please enter your email" value="{{ isset($volunteer) ? $volunteer->email : old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Please enter your address" value="{{ isset($volunteer) ? $volunteer->address : old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Please enter your phone" value="{{ isset($volunteer) ? $volunteer->phone : old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn-donate w-100-p donate-now mt-3">Donate Now</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#donation-amount").val("50");
    $(".donation-button").on('click',function () {
        $(".donation-button").removeClass("selected");
        var amount = $(this).data("amount");
        $("#donation-amount").val(amount);
        $(this).addClass("selected");
        if (amount === "") {
            $("#donation-amount").focus();
        }
    });
});
</script>
@endsection
