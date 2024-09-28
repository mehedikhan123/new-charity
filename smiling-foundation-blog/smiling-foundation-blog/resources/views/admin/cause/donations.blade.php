@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Cause {{ $cause ? ($cause->name) : '' }} Donations</h1>
            <div>
                <a href="{{ route('admin.causes.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Causes</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Payment Id</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_price = 0;
                                        @endphp
                                        @foreach ($causeDonations as $donation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                $user = App\Models\User::find($donation->user_id);
                                                @endphp
                                                {{ $user->name }}<br>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $donation->donation_type }}
                                            </td>
                                            <td>
                                                @php
                                                $original_text = $donation->payment_id;
                                                $max_length = 40;
                                                if(strlen($original_text) > $max_length) {
                                                    $line1 = substr($original_text, 0, $max_length);
                                                    $line2 = substr($original_text, $max_length);
                                                }
                                                else {
                                                    $line1 = $original_text;
                                                    $line2 = "";
                                                }
                                                echo $line1 . "<br>" . $line2;
                                                @endphp
                                            </td>
                                            <td>
                                                ${{ $donation->price }}
                                            </td>
                                            <td style="width:140px;">
                                                <a href="{{ isset($cause) ? route('admin.causes.donation-invoice',[$cause->slug, $donation->id]) : route('admin.causes.donation-invoices', $donation->id) }}" class="btn btn-primary btn-sm">See Invoice</a>
                                            </td>
                                        </tr>
                                        @php
                                        $total_price += $donation->price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="3" style="text-align:right;">
                                                <h5>Total Donations:</h5>
                                            </td>
                                            <td>
                                                <h5>${{ $total_price }}</h5>
                                            </td>
                                        </tr>
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