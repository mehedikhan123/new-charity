@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Program ({{ $program->name }}) Tickets</h1>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Programs</a>
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
                                            <th>Payment Id</th>
                                            <th>Unit Price</th>
                                            <th>Number of Tickets</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_tickets = 0;
                                        $total_price = 0;
                                        @endphp
                                        @foreach ($programTickets as $programTicket)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                $user = App\Models\User::find($programTicket->user_id);
                                                @endphp
                                                {{ $user->name }}<br>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                @php
                                                $original_text = $programTicket->payment_id;
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
                                                ${{ $programTicket->unit_price }}
                                            </td>
                                            <td>
                                                {{ $programTicket->number_of_tickets }}
                                            </td>
                                            <td>
                                                ${{ $programTicket->total_price }}
                                            </td>
                                            <td style="width:140px;">
                                                <a href="{{ route('admin.programs.ticket-invoice',[$program->slug, $programTicket->id]) }}" class="btn btn-primary btn-sm">See Invoice</a>
                                            </td>
                                        </tr>
                                        @php
                                        $total_tickets += $programTicket->number_of_tickets;
                                        $total_price += $programTicket->total_price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4" style="text-align:right">
                                                <h5>Total Tickets</h5>
                                            </td>
                                            <td>
                                                <h5>{{ $total_tickets }}</h5>
                                            </td>
                                            <td>
                                                <h5>${{ $total_price }}</h5>
                                            </td>
                                            <td></td>
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