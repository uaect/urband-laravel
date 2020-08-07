@extends('layouts.app', ['title' => __('User Management')])
@section('pages_css')
<style type="text/css">
.file {
  visibility: hidden;
  position: absolute;
}
</style>
@endsection

@section('content')
    @include('events.partials.header', ['title' => __('Edit User')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary"><span><i class="fas fa-arrow-left"></i></span>
                                    <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('event.update', $event) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Event information') }}</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Title') }}" value="{{ old('title', $event->title) }}" required autofocus>

                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('headline') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-headline">{{ __('Headline') }}</label>
                                    <input type="text" name="headline" id="input-headline"
                                        class="form-control form-control-alternative{{ $errors->has('headline') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Headline') }}" value="{{ old('headline', $event->headline) }}" required>

                                    @if ($errors->has('headline'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('headline') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('date_on') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Date') }}</label>
                                    <input type="text" name="date_on" id="input-name"
                                        class="form-control datepicker form-control-alternative{{ $errors->has('date_on') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Date') }}" value="{{ old('date_on', $event->date_on) }}" required autofocus>

                                    @if ($errors->has('date_on'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_on') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('Location') }}</label>
                                    <input type="text" name="location" id="input-location"
                                        class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Location') }}" value="{{ old('location', $event->location) }}" required>

                                    @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <textarea name="description"
                                        class="form-control ckeditor form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Description') }}" autofocus>{{ old('description', $event->description) }}</textarea>

                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <input type="file" name="image" class="file" accept="image/*">
                            <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                            <div class="input-group-append">
                                <button type="button" class="browse btn btn-primary">Browse...</button>
                            </div>
                            </div>
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
<script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('argon') }}/vendor/ckeditor/ckeditor.js"></script>
<script>
$('.datepicker').datepicker({
    format:  'yyyy-mm-dd',
    autoclose: true
});
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
</script>
@endsection
