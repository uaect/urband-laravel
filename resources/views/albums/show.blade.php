@extends('layouts.app', ['title' => __('Album Details')])

@section('content')
    @include('albums.partials.header', [
        'title' => $album->title,
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
                                    <img @if($album->image) src="/storage/{{ @$album->image }}" @else src="{{ asset('argon') }}/img/theme/no_image.png" @endif class="image">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('album.index') }}" class="btn btn-sm btn-default float-right"><span><i class="fas fa-arrow-left"></i></span>
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
                                {{ $album->name }}<span class="font-weight-light"></span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $album->headline }}
                            </div>
                            <p>{{$album->description}}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <h4>Track List</h4>
                                <table class="table" id="dynamicTable">
                                    <tr>
                                        <th>Title</th>
                                        <th>Artist</th>
                                        <th>File</th>
                                    </tr>
                                    <?php if(count(@$album->tracks)>0){ foreach(@$album->tracks as $list){ ?>
                                    <tr>
                                        <td>{{$list->title}}</td>
                                        <td>@foreach($artist as $val)
                                             {{ ($list->artist_id==$val->id)?$val->name:'' }}
                                                @endforeach</td>
                                        <td><audio controls>
                                        <source src="horse.ogg" type="audio/ogg">
                                        <source src="/storage/{{$list->file}}" type="audio/mpeg">
                                        Your browser does not support the audio tag.
                                        </audio></td>
                                    </tr>
                                    <?php }} ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
