@extends('layouts.app', ['title' => __('Event Details')])

@section('content')
    @include('events.partials.header', [
        'title' => $event->title,
        'description' => __(''),
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
                                    <img @if($event->image) src="/storage/{{ @$event->image }}" @else src="{{ asset('argon') }}/img/theme/no_image.png" @endif class="image">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header  border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('event.index') }}" class="btn btn-sm btn-default float-right"><span><i class="fas fa-arrow-left"></i></span>
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
                        <div class="">
                            <h3>
                                {{ $event->title }}<span class="font-weight-light"></span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $event->headline }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>From : {{ $event->date_from }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>To : {{ $event->date_to }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Time From : {{ $event->time_from }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Time To : {{ $event->time_to }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>Location : {{ $event->location }}
                            </div>
                            <p>{{$event->description}}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <h4>Artist List</h4>
                                <table class="table" id="dynamicTable">
                                    <tr>
                                        <th>Artist</th>
                                        <th>Time From</th>
                                        <th>Time To</th>
                                        <th>Band Name</th>
                                        <th>Duration</th>
                                    </tr>
                                    <?php if(count(@$event->list)>0){ $i = 0; foreach(@$event->list as $list){ ?>
                                    <tr>
                                    <td>@foreach($artist as $val)
                                             {{ ($list->artist_id==$val->id)?$val->name:'' }}
                                                @endforeach</td>
                                        <td>{{$list->from}}</td>
                                        <td>{{$list->to}}</td>
                                        <td>{{$list->band_name}}</td>
                                        <td>{{$list->duration}}</td>
                                    </tr>
                                    <?php $i++; }} ?>
                                </table>
                            </div>
                        </div>
                        <?php if(count(@$event->packages)>0){ ?>
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Packages List</h4>
                                <table class="table">
                                    <tr>
                                        <th>Package Name</th>
                                        <th>Tickets Available</th>
                                        <th>Ticket Price</th>
                                    </tr>
                                    <?php if(count(@$event->packages)>0){ foreach(@$event->packages as $package){ ?>
                                    <tr>
                                        <td>{{$package->package_name}}</td>
                                        <td>{{$package->tickets_available}}</td>
                                        <td>{{$package->price}}</td>
                                    </tr>
                                    <?php }} ?>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
