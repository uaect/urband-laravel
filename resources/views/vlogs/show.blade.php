@extends('layouts.app', ['title' => __('Vlog Detail')])

@section('content')
    @include('vlogs.partials.header', [
        'title' => $vlogs->title,
        'description' => '',
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vlogs.index') }}" class="btn btn-sm btn-default float-right"><span><i class="fas fa-arrow-left"></i></span>
                                    <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                                {{ $vlogs->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
