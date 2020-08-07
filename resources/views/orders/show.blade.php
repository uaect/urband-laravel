@extends('layouts.app', ['title' => __('Orders Details')])

@section('content')
@include('orders.partials.header', [
'title' => $orders->title,
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
                            <img class="mb-2 w-10" width="100"
                                src="<?php if(@$company) {?>/storage/{{ @$company->contentImage() }}<?php } ?>"
                                alt="Logo">
                            <h6>
                                {{ $company->location }}
                            </h6>
                            <small class="d-block text-muted">tel: {{ $company->phone }}</small>
                        </div>
                        <div class="col-lg-3 col-md-4 text-left mt-3">
                            <h4 class="mb-1">Payment Mode:</h4>
                            <span class="d-block">{{ $orders->payment_option }}</span>
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
                            <h3 class="mt-3 text-left">Invoice no <br><small
                                    class="mr-2">#{{ $orders->tracking_id }}</small></h3>
                        </div>
                        <div class="col-lg-4 col-md-5">
                            <div class="row mt-5">
                                <div class="col-md-6">Invoice date:</div>
                                <div class="col-md-6">{{ date('d-m-Y', strtotime($orders->created_at))}}</div>
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
                                            <th scope="col" class="text-right text-white">Image</th>
                                            <th scope="col" class="text-right text-white">Item</th>
                                            <th scope="col" class="text-right text-white">Qty</th>
                                            <th scope="col" class="text-right text-white">Rate</th>
                                            <th scope="col" class="text-right text-white">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $subtotal = 0; if(count(@$items)>0){  $i = 0; foreach(@$items as $item){ ?>
                                        <tr>
                                            <td><img @if($item->productimage->image) src="/storage/{{ @$item->productimage->image }}" @else src="{{ asset('argon') }}/img/theme/no_image.png" @endif class="img-thumbnail" width="100"></td>
                                            <td>{{ $item->product->title }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <?php $total = $item->price*$item->quantity;
                            $subtotal += $total; ?>
                                            <td>{{ $total }}</td>
                                        </tr>
                                        <?php $i++; }} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="h4">Total</th>
                                            <th colspan="3" class="text-right h4"><?=number_format($subtotal, 2)?></th>
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
                        <?php $shipping_charge = $orders->delivery_charge; ?>
                        <h6 class="d-block">Shipping Charge : <?php if(@$orders->delivery_charge){ echo $orders->delivery_charge.' AED'; }else{ echo 'Free Shipping'; }?></h6>
                        <?php $grandtotal = $subtotal+$shipping_charge; ?>
                        <h5>Grand Total : <?=number_format($grandtotal, 2)?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mx-auto">
        <div class="card card-invoice">
                <div class="card-header text-center">
                </div>
                <div class="card-body shadow">
                        <h3 class="mt-3 text-left">Shipping Status Details <br></h3>
                        <form method="post" action="{{ route('orders.updatestatus',$orders->id) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">

                            <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                    <select
                                        class="form-control js-example-basic-multiple form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                        name="status" id="input-artist">
                                        <option value="">Select Status</option>
                                        <?php $status = array('Ordered','Proccessing','Shipped','Delivered','Cancelled'); ?>
                                        @foreach($status as $status)
                                        <option value="{{$status}}" {{old('status')==$status?'selected':''}}>{{$status}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-note">{{ __('Note') }}</label>
                                    <input type="text" name="note" id="input-note"
                                        class="form-control form-control-alternative{{ $errors->has('note') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Note') }}" value="{{ old('note') }}" required>

                                    @if ($errors->has('note'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4"><span><i
                                                class="fas fa-cloud-upload-alt"></i></span>
                                        <span class="btn-inner--text">{{ __('Save') }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-default">
                                        <tr>
                                            <th scope="col" class="text-white">Status</th>
                                            <th scope="col" class="text-white">Date</th>
                                            <th scope="col" class="text-white">Note</th>
                                            <th scope="col" class="text-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $subtotal = 0; if(count(@$orders->shippingupdates)>0){  $i = 0; foreach(@$orders->shippingupdates as $shipping){ ?>
                                        <tr id="item{{ $shipping->id }}">
                                            <td>{{ $shipping->status }}</td>
                                            <td>{{ date('d-m-Y', strtotime($shipping->created_at))}}</td>
                                            <td>{{ $shipping->note }}</td>
                                            <td>
                                            <a class="btn btn-icon btn-sm btn-danger destroy-status" href="javascript:void(0);" item-id="{{ $shipping->id }}">
                                                <span><i class="far fa-trash-alt"></i></span>
                                                <span class="btn-inner--text">{{ __('Delete') }}</span>
                                            </a>
                                        </td>
                                        </tr>
                                        <?php $i++; }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </br>
                </div>
        </div>
    </div>
        <div class="col-md-3 mt-5">
            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-default float-left"><span><i
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
$(document).on('click', '.destroy-status', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var item_id = $(this).attr('item-id');
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            width: '100%',
            showConfirmButton: false,
            customClass: 'swal-wide',
            timer: 3000
        });

        Toast.fire({
            type: 'success',
            title: 'Deleted successfully'
        })
        $.ajax({
            type: 'POST',
            url: '/orders/destroystatus',
            method: 'POST',
            headers: {
                   'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
                  },
            data: {item_id:item_id},
            success: function(data) {
            $("#item"+item_id).remove();
            },
        });
    });
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>
@endsection
