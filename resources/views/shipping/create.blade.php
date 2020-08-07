@extends('layouts.app', ['title' => __('Shipping Charges Management')])

@section('content')
@include('shipping.partials.header', ['title' => __('Add Shipping Charges')])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Shipping Charges Management') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('shipping.index') }}"
                                class="btn btn-sm btn-primary"><span><i class="fas fa-arrow-left"></i></span>
                                    <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('shipping.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Shipping Charges information') }}</h6>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('cities') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-cities">{{ __('City') }}</label>
                                    <select
                                        class="form-control js-example-basic-multiple form-control-alternative{{ $errors->has('cities') ? ' is-invalid' : '' }}"
                                        name="cities" id="input-artist" required>
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{old('cities')==$city->id?'selected':''}}>{{$city->location}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cities'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cities') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{ __('Price') }}</label>
                                    <input type="text" name="amount" id="input-amount"
                                        class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Price') }}" value="{{ old('amount') }}" required autofocus>

                                    @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('estimate_time') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-estimate_time">{{ __('Estimated Days') }}</label>
                                    <select
                                        class="form-control js-example-basic-multiple form-control-alternative{{ $errors->has('estimate_time') ? ' is-invalid' : '' }}"
                                        name="estimate_time" id="input-artist" required>
                                        <option value="">Select Estimated Days</option>
                                        <?php $j=0; foreach ( range( 1, 20 ) as $day ) { $j++; ?>
                                        <option class="item" value="<?php echo $day; ?>" {{old('estimate_time')==$day?'selected':''}}><?php echo $day; ?> Day<?php if($j!=1) echo 's'; ?></option>
                                        <?php } ?>
                                    </select>
                                    @if ($errors->has('estimate_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estimate_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4"><span><i class="fas fa-cloud-upload-alt"></i></span>
                                    <span class="btn-inner--text">{{ __('Save') }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
