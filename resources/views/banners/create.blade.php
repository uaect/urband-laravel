@extends('layouts.app', ['title' => __('Banner Management')])
@section('pages_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
.file {
  visibility: hidden;
  position: absolute;
}
</style>
@endsection

@section('content')
@include('banners.partials.header', ['title' => __('Add Banner')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Banner Management') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('banner.index') }}"
                                class="btn btn-sm btn-primary"><span><i class="fas fa-arrow-left"></i></span>
                                    <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('banner.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Banner information') }}</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('sub_title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-sub_title">{{ __('Sub Title') }}</label>
                                    <input type="text" name="sub_title" id="input-sub_title"
                                        class="form-control form-control-alternative{{ $errors->has('sub_title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Sub Title') }}" value="{{ old('sub_title') }}" required>

                                    @if ($errors->has('sub_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sub_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('page') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-page">{{ __('Pages') }}</label>
                                    <select class="form-control js-example-basic-multiple form-control-alternative{{ $errors->has('page') ? ' is-invalid' : '' }}" name="page[]" multiple="multiple">
                                        <?php $pages = array('Home','About','Events','Event Detail','Artist','Artist Detail','Clients','Radio','Blog','Gallery','Event Tickets','Studio Bookings','Merchandise','Contact','Albums','Album Detail','Store','Store Detail');
                                        foreach($pages as $page){ ?>
                                        <option value="<?php echo $page; ?>" {{in_array($page, old("page") ?: []) ? "selected": ""}}><?php echo $page; ?></option>
                                        <?php } ?>
                                    </select>
                                    @if ($errors->has('page'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('page') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <input type="file" name="image" class="file" accept="image/jpg,image/jpeg,image/JPG,image/JPEG,image/png,image/PNG,image/gif,image/GIF">
                            <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                            <div class="input-group-append">
                                <button type="button" class="browse btn btn-primary">Browse...</button>
                            </div>
                            </div>
                            @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert" style="display:block;">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                            <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail" style="display:none;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
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
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection
