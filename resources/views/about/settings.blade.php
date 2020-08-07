@extends('layouts.app', ['title' => __('Website Settings')])
@section('pages_css')
<style type="text/css">
.file {
  visibility: hidden;
  position: absolute;
}
</style>
@endsection

@section('content')
@include('about.partials.header', ['title' => __('Website Settings')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Website Settings') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('about.insert_settings') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email"
                                        class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Email') }}" value="{{ old('email',@$about->email) }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('order_email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-order_email">{{ __('Order Email') }}</label>
                                    <input type="email" name="order_email" id="input-order_email"
                                        class="form-control form-control-alternative{{ $errors->has('order_email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Order Email') }}" value="{{ old('order_email',@$about->description) }}" required>

                                    @if ($errors->has('order_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('order_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Phone') }}" value="{{ old('phone',@$about->phone) }}" required autofocus>

                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('Location') }}</label>
                                    <input type="text" name="location" id="input-location"
                                        class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Location') }}" value="{{ old('location',@$about->location) }}" required>

                                    @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('latitude') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Latitude') }}</label>
                                    <input type="text" name="latitude" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('latitude') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Latitude') }}" value="{{ old('latitude',@$about->latitude) }}" required autofocus>

                                    @if ($errors->has('latitude'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('longitude') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-longitude">{{ __('Longitude') }}</label>
                                    <input type="text" name="longitude" id="input-longitude"
                                        class="form-control form-control-alternative{{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Longitude') }}" value="{{ old('longitude',@$about->longitude) }}" required>

                                    @if ($errors->has('longitude'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php  foreach(@$details as $detail){
                                    if($detail->title == 'Founded'){
                                        $name = 'founded';
                                        $value = @$detail->description;
                                    }
                                    if($detail->title == 'Doing'){
                                        $name = 'doing';
                                        $value = @$detail->description;
                                    }
                                    if($detail->title == 'Clients'){
                                        $name = 'clients';
                                        $value = @$detail->description;
                                    }
                                    if($detail->title == 'Events'){
                                        $name = 'events';
                                        $value = @$detail->description;
                                    } ?>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has($name) ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-{{$name}}">{{ __($detail->title) }}</label>
                                    <input type="text" name="{{$name}}" id="input-{{$name}}"
                                        class="form-control form-control-alternative{{ $errors->has($name) ? ' is-invalid' : '' }}"
                                        placeholder="{{ __($detail->title) }}" value="{{ old($name,@$value) }}" required>

                                    @if ($errors->has($name))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($name) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group{{ $errors->has('doing') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-doing">{{ __('Doing') }}</label>
                                    <input type="text" name="doing" id="input-doing"
                                        class="form-control form-control-alternative{{ $errors->has('doing') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Doing') }}" value="{{ old('doing',@$doing) }}" required autofocus>

                                    @if ($errors->has('doing'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('doing') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('clients') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-clients">{{ __('Clients') }}</label>
                                    <input type="text" name="clients" id="input-clients"
                                        class="form-control form-control-alternative{{ $errors->has('clients') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Clients') }}" value="{{ old('clients',@$clients) }}" required>

                                    @if ($errors->has('clients'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('clients') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('events') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-events">{{ __('Events') }}</label>
                                    <input type="text" name="events" id="input-events"
                                        class="form-control form-control-alternative{{ $errors->has('events') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Events') }}" value="{{ old('events',@$events) }}" required>

                                    @if ($errors->has('events'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('events') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> -->
                                <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <label class="form-control-label" for="input-logo">{{ __('Header Logo') }}</label>
                            <input type="file" name="image" class="file" accept="image/*">
                            <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload Logo" id="file">
                            <div class="input-group-append">
                                <button type="button" id="input-logo" class="browse btn btn-primary">Browse...</button>
                            </div>
                            </div>
                            <?php //$remoteImage = public_path("/storage/".@$about->contentImage());
                                    //$imginfo = getimagesize($remoteImage);
                                    //header("Content-type: {$imginfo['mime']}");
                                    //$image = readfile($remoteImage); ?>
                            <img src="<?php if(@$about) {?>/storage/{{ @$about->contentImage() }}<?php } ?>" id="preview" class="img-thumbnail">
                            </div>
                        </div>

                        <div class="row">&nbsp;</div>
                        <div class="row" @if(!$social) style="display:none;" @endif id="social">
                            <div class="col-md-10">
                                <h4>Social Media List</h4>
                                <table class="table" id="socialTable">
                                    <tr>
                                        <th>Social Media</th>
                                        <th>URL</th>
                                        <th></th>
                                    </tr>
                                    <?php $social_links = array('Facebook','Twitter','Youtube','LinkedIn','Instagram','SoundCloud','Vimeo'); ?>
                                    <?php if(count(@$social)>0){ $i = 0; foreach(@$social as $val){ ?>
                                    <tr>
                                        <td><select class="form-control" name="social[{{@$i}}][title]" required>
                                                <option value="">Select Social Media</option>
                                                @foreach($social_links as $links)
                                                <option value="{{$links}}" {{($links==$val->title)?'selected':''}}>{{$links}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="url" name="social[{{@$i}}][url]" value="{{$val->description}}"
                                                placeholder="Enter Tickets Available" class="form-control" required/>
                                        </td>
                                        <td>
                                        @if ($i==0)
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                        @else
                                        <button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">Remove</button>
                                        @endif
                                        </td>
                                    </tr>
                                    <?php $i++; }}else{ ?>
                                        <tr>
                                        <td><select class="form-control" name="social[{{@$i}}][title]" required>
                                                <option value="">Select Social Media</option>
                                                @foreach($social_links as $links)
                                                <option value="{{$links}}">{{$links}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="url" name="social[0][url]"
                                                placeholder="Enter Link"  class="form-control" required/>
                                        </td>
                                        <td><button type="button" name="add" id="add"
                                                class="btn btn-success">Add
                                                More</button></td>
                                    </tr>
                                   <?php } ?>
                                </table>
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

@section('pages_js')
<script src="{{ asset('argon') }}/vendor/ckeditor/ckeditor.js"></script>
<script>
$(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $('#preview').fadeIn('200');
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});
var i = 0;
    $("#add").click(function () {
        ++i;
        var options_str = '';
        <?php foreach($social_links as $val) {?>
                options_str += '<option value="{{$val}}">{{$val}}</option>';
        <?php } ?>
            $("#socialTable").append('<tr><td><select class="form-control" name="social[' + i + '][title]">\
                                <option value="">Select Social Media</option>' + options_str + '</select></td>\
                                <td><input type="url" name="social[' + i + '][url]" placeholder="Enter Link"  class="form-control" required/></td>\
                                <td><button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">\
                            Remove</button>\
                            </td></tr>');
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
