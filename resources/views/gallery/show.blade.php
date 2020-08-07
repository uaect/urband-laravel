@extends('layouts.app', ['title' => __('Gallery Detail')])

@section('content')
    @include('gallery.partials.header', [
        'title' => $gallery->title,
        'description' => $gallery->category,
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                @if($gallery->galleryImages)
                                @foreach($gallery->galleryImages as $val)
                                    <img @if($val->image) src="/storage/{{ @$val->image }}" @else src="{{ asset('argon') }}/img/theme/no_image.png" @endif class="image">
                                @endforeach
                                @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('gallery.index') }}" class="btn btn-sm btn-default float-right"><span><i class="fas fa-arrow-left"></i></span>
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
                            <h3>
                                {{ $gallery->sub_title }}<span class="font-weight-light"></span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
