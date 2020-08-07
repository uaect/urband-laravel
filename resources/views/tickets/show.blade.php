@extends('layouts.app', ['title' => __('Event Ticket Details')])

@section('content')
@include('tickets.partials.header', [
'title' => $tickets->title,
'description' => __(''),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card card-invoice" id="invoice">
                <div class="card-header text-center">
                    <div class="row justify-content-between">
                        <div class="col-md-4 text-left">
                            <img class="mb-2 w-10" width="200"
                                src="<?php if(@$company) {?>/storage/{{ @$company->contentImage() }}<?php } ?>"
                                alt="Logo">
                            <h6>
                                {{ $company->location }}
                            </h6>
                            <small class="d-block text-muted">tel: {{ $company->phone }}</small>
                        </div>
                        <div class="col-lg-3 col-md-4 text-left mt-3">
                            <h4 class="mb-1">Payment Mode:</h4>
                            <span class="d-block">{{ $tickets->payment_option }}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 text-left mt-3">
                            <h4 class="mb-1">Billed to:</h4>
                            <span class="d-block">{{ $address->first_name.' '.$address->last_name }}</span>
                            <p>{{ $address->roomno }},{{ $address->building }}<br>
                                {{ $address->street }},<br>
                                {{ $address->area }},{{ $address->emirate }}<br>
                                Phone: {{ $address->mobile }}
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-md-between">
                        <div class="col-md-4">
                            <h3 class="mt-3 text-left">Booking ID <br><small
                                    class="mr-2">#{{ $tickets->booking_id }}</small></h3>
                        </div>
                        <div class="col-lg-4 col-md-5">
                            <div class="row mt-5">
                                <div class="col-md-6">Invoice date:</div>
                                <div class="col-md-6">{{ date('d-m-Y', strtotime($tickets->created_at))}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table text-right">
                                    <thead class="bg-default">
                                        <tr>
                                            <th scope="col" class="text-right text-white">Event</th>
                                            <th scope="col" class="text-right text-white">Ticket</th>
                                            <th scope="col" class="text-right text-white">Qty</th>
                                            <th scope="col" class="text-right text-white">Rate</th>
                                            <th scope="col" class="text-right text-white">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $subtotal = 0; if(@$tickets){  ?>
                                        <tr>
                                            <td>{{ $tickets->event->title }}</td>
                                            <td>{{ $tickets->package->package_name }}</td>
                                            <td>{{ $tickets->quantity }}</td>
                                            <td>{{ $tickets->price }}</td>
                                            <?php $total = $tickets->price*$tickets->quantity;
                                                $subtotal += $total; ?>
                                            <td>{{ $total }}</td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="h4">Total</th>
                                            <th colspan="4" class="text-right h4"><?=number_format($subtotal, 2)?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="col-md-5 ml-auto">
                    </div>
                    <div class="col-md-5 ml-auto">
                        <?php $grandtotal = $subtotal; ?>
                        <h5>Grand Total : <?=number_format($grandtotal, 2)?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-5">
            <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-default float-left"><span><i
                        class="fas fa-arrow-left"></i></span>
                <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
        </div>
        <div class="col-md-3 mt-5">
            <button type="button" class="btn btn-sm btn-default float-right" onclick="printDiv('invoice')" >
                <i class="tim-icons icon-laptop"></i>
                Print
            </button>
        </div>
        </div>
    @include('layouts.footers.auth')
</div>
@endsection

@section('pages_js')
<script src="{{ asset('argon') }}/js/sweetalert2.all.min.js"></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>
@endsection
