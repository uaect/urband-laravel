@extends('layouts.app', ['title' => __('Spotlight')])
@section('pages_css')
<link rel="stylesheet" type="text/css" href="{{ asset('argon') }}/css/dropzone.css">
<style type="text/css">
.file {
  visibility: hidden;
  position: absolute;
}
</style>
@endsection

@section('content')
@include('previous_shows.partials.header', ['title' => __('Spotlight')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Spotlight') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('previous_shows.insertspotlight') }}" autocomplete="off" enctype="multipart/form-data" id="previous_shows">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Title') }}" value="{{ old('title',@$previous_shows->title) }}" required>

                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group{{ $errors->has('video_url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-video_url">{{ __('Youtube URL') }}</label>
                                    <input type="url" name="video_url" id="input-video_url"
                                        class="form-control form-control-alternative{{ $errors->has('video_url') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Youtube URL') }}" value="{{ old('video_url',@$previous_shows->video_url) }}"
                                        required>

                                    @if ($errors->has('video_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('video_url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="pro-imgs">
                                <h5 class="mb-0">
                                    <h4>Images</h4>
                                    <div class="form-group{{ $errors->has('document') ? ' has-danger' : '' }}">
                                    @if ($errors->has('document'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>Images required</strong>
                                    </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="needsclick dropzone" id="document-dropzone">
                                        </div>
                                    </div>
                                </h5>
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
<script src="{{ asset('argon') }}/js/dropzone.js"></script>
<script>
    $(document).on("click", ".browse", function () {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
    //autoProcessQueue: false,
    url: '{{ route('previous_shows.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    dictDefaultMessage: "<img class='dropzone-add-img add-file-drop' style='width: 80px; margin-left: 10px;' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6Izk5OTk5OTsiIGQ9Ik01MTIsMGgtNDB2MTZoMjR2MzJoMTZWMHogTTQzMiwwaC00MHYxNmg0MFYweiBNMzUyLDBoLTQwdjE2aDQwVjB6IE0yNzIsMGgtNDB2MTZoNDBWMHogTTE5MiwwaC00MCAgdjE2aDQwVjB6IE0xMTIsMEg3MnYxNmg0MFYweiBNMzIsMEgwdjE2aDMyVjB6IE0xNiw0OEgwdjQwaDE2VjQ4eiBNMTYsMTI4SDB2NDBoMTZWMTI4eiBNMTYsMjA4SDB2NDBoMTZWMjA4eiBNMTYsMjg4SDB2NDBoMTZWMjg4eiAgIE0xNiwzNjhIMHY0MGgxNlYzNjh6IE0xNiw0NDhIMHY0MGgxNlY0NDh6IE01Niw0OTZIMTZ2MTZoNDBWNDk2eiBNMTM2LDQ5Nkg5NnYxNmg0MFY0OTZ6IE0yMTYsNDk2aC00MHYxNmg0MFY0OTZ6IE0yOTYsNDk2aC00MHYxNiAgaDQwVjQ5NnogTTM3Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTQ1Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTUxMiw0ODhoLTE2djhsMCwwdjE2aDE2VjQ4OHogTTUxMiw0MDhoLTE2djQwaDE2VjQwOHogTTUxMiwzMjhoLTE2djQwICBoMTZWMzI4eiBNNTEyLDI0OGgtMTZ2NDBoMTZWMjQ4eiBNNTEyLDE2OGgtMTZ2NDBoMTZWMTY4eiBNNTEyLDg4aC0xNnY0MGgxNlY4OHoiLz4KPGc+Cgk8cmVjdCB4PSIyNDQiIHk9IjE3NS45NzYiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMjQiIGhlaWdodD0iMTYwLjA4Ii8+Cgk8cmVjdCB4PSIxNzUuOTc2IiB5PSIyNDQiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMTYwLjA4IiBoZWlnaHQ9IjI0Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==' /> Drop or browse images here to upload",
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    acceptedFiles: ".jpg,.JPG,.jpeg,.JPEG,.png,.PNG",
    dictInvalidFileType: "You can't upload files of this type.",
    dictFileTooBig: "File is too big.",
    dictRemoveFile: '<div title="Remove"><i class="fa fa-times-circle" aria-hidden="true"></i></div>',
    dictRemoveFileConfirmation: 'Are you sure you want to delete this image?',
    init: function () {
        var myDropzone = this;
        $("#document-dropzone .dz-default").remove();
        $("#submit_form").click(function (e) {
            //e.preventDefault();
            myDropzone.processQueue();
            //myDropzone.on("complete", function (file) {
            if (myDropzone.files || myDropzone.files.length) {
            setTimeout(function() {
                $('#previous_shows').submit();
            }, 500);
            }else{

            }
            //});
        });
      @if(isset($previous_shows) && isset($images))
        var files = {!! json_encode($images) !!}
        for (var i in files) {
          var file = files[i]
          console.log(file);
          myDropzone.options.addedfile.call(myDropzone, file);
          myDropzone.options.thumbnail.call(myDropzone, file, "/storage/" + file);
          file.previewElement.classList.add('dz-complete')
          $('#previous_shows').append('<input type="hidden" name="document[]" value="' + file + '">')
        }
      @endif

      $("#document-dropzone").append(
                '<div class="dz-default dz-message" style="display:inline-block !important;"><span><img class="dropzone-add-img add-file-drop" style="width: 80px; margin-left: 10px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6Izk5OTk5OTsiIGQ9Ik01MTIsMGgtNDB2MTZoMjR2MzJoMTZWMHogTTQzMiwwaC00MHYxNmg0MFYweiBNMzUyLDBoLTQwdjE2aDQwVjB6IE0yNzIsMGgtNDB2MTZoNDBWMHogTTE5MiwwaC00MCAgdjE2aDQwVjB6IE0xMTIsMEg3MnYxNmg0MFYweiBNMzIsMEgwdjE2aDMyVjB6IE0xNiw0OEgwdjQwaDE2VjQ4eiBNMTYsMTI4SDB2NDBoMTZWMTI4eiBNMTYsMjA4SDB2NDBoMTZWMjA4eiBNMTYsMjg4SDB2NDBoMTZWMjg4eiAgIE0xNiwzNjhIMHY0MGgxNlYzNjh6IE0xNiw0NDhIMHY0MGgxNlY0NDh6IE01Niw0OTZIMTZ2MTZoNDBWNDk2eiBNMTM2LDQ5Nkg5NnYxNmg0MFY0OTZ6IE0yMTYsNDk2aC00MHYxNmg0MFY0OTZ6IE0yOTYsNDk2aC00MHYxNiAgaDQwVjQ5NnogTTM3Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTQ1Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTUxMiw0ODhoLTE2djhsMCwwdjE2aDE2VjQ4OHogTTUxMiw0MDhoLTE2djQwaDE2VjQwOHogTTUxMiwzMjhoLTE2djQwICBoMTZWMzI4eiBNNTEyLDI0OGgtMTZ2NDBoMTZWMjQ4eiBNNTEyLDE2OGgtMTZ2NDBoMTZWMTY4eiBNNTEyLDg4aC0xNnY0MGgxNlY4OHoiLz4KPGc+Cgk8cmVjdCB4PSIyNDQiIHk9IjE3NS45NzYiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMjQiIGhlaWdodD0iMTYwLjA4Ii8+Cgk8cmVjdCB4PSIxNzUuOTc2IiB5PSIyNDQiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMTYwLjA4IiBoZWlnaHQ9IjI0Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="> Add More</span></div>'
            );
      this.on("addedfile", function(file) {
                $("#document-dropzone .dz-default").remove();
                $("#document-dropzone").append(
                    '<div class="dz-default dz-message" style="display:inline-block !important;"><span><img class="dropzone-add-img add-file-drop" style="width: 80px; margin-left: 10px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6Izk5OTk5OTsiIGQ9Ik01MTIsMGgtNDB2MTZoMjR2MzJoMTZWMHogTTQzMiwwaC00MHYxNmg0MFYweiBNMzUyLDBoLTQwdjE2aDQwVjB6IE0yNzIsMGgtNDB2MTZoNDBWMHogTTE5MiwwaC00MCAgdjE2aDQwVjB6IE0xMTIsMEg3MnYxNmg0MFYweiBNMzIsMEgwdjE2aDMyVjB6IE0xNiw0OEgwdjQwaDE2VjQ4eiBNMTYsMTI4SDB2NDBoMTZWMTI4eiBNMTYsMjA4SDB2NDBoMTZWMjA4eiBNMTYsMjg4SDB2NDBoMTZWMjg4eiAgIE0xNiwzNjhIMHY0MGgxNlYzNjh6IE0xNiw0NDhIMHY0MGgxNlY0NDh6IE01Niw0OTZIMTZ2MTZoNDBWNDk2eiBNMTM2LDQ5Nkg5NnYxNmg0MFY0OTZ6IE0yMTYsNDk2aC00MHYxNmg0MFY0OTZ6IE0yOTYsNDk2aC00MHYxNiAgaDQwVjQ5NnogTTM3Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTQ1Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTUxMiw0ODhoLTE2djhsMCwwdjE2aDE2VjQ4OHogTTUxMiw0MDhoLTE2djQwaDE2VjQwOHogTTUxMiwzMjhoLTE2djQwICBoMTZWMzI4eiBNNTEyLDI0OGgtMTZ2NDBoMTZWMjQ4eiBNNTEyLDE2OGgtMTZ2NDBoMTZWMTY4eiBNNTEyLDg4aC0xNnY0MGgxNlY4OHoiLz4KPGc+Cgk8cmVjdCB4PSIyNDQiIHk9IjE3NS45NzYiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMjQiIGhlaWdodD0iMTYwLjA4Ii8+Cgk8cmVjdCB4PSIxNzUuOTc2IiB5PSIyNDQiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMTYwLjA4IiBoZWlnaHQ9IjI0Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="> Add More</span></div>'
                );
            });
      this.on('success', function(file, response) {
            $("#document-dropzone .dz-default").remove();
            $('.dz-preview').fadeIn(200);
            file.newname = response;
            setTimeout(function() {
                $("#images").val(response).change();
            }, 100)
            $("#document-dropzone").append(
                '<div class="dz-default dz-message" style="display:inline-block !important;"><span><img class="dropzone-add-img add-file-drop" style="width: 80px; margin-left: 10px;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6Izk5OTk5OTsiIGQ9Ik01MTIsMGgtNDB2MTZoMjR2MzJoMTZWMHogTTQzMiwwaC00MHYxNmg0MFYweiBNMzUyLDBoLTQwdjE2aDQwVjB6IE0yNzIsMGgtNDB2MTZoNDBWMHogTTE5MiwwaC00MCAgdjE2aDQwVjB6IE0xMTIsMEg3MnYxNmg0MFYweiBNMzIsMEgwdjE2aDMyVjB6IE0xNiw0OEgwdjQwaDE2VjQ4eiBNMTYsMTI4SDB2NDBoMTZWMTI4eiBNMTYsMjA4SDB2NDBoMTZWMjA4eiBNMTYsMjg4SDB2NDBoMTZWMjg4eiAgIE0xNiwzNjhIMHY0MGgxNlYzNjh6IE0xNiw0NDhIMHY0MGgxNlY0NDh6IE01Niw0OTZIMTZ2MTZoNDBWNDk2eiBNMTM2LDQ5Nkg5NnYxNmg0MFY0OTZ6IE0yMTYsNDk2aC00MHYxNmg0MFY0OTZ6IE0yOTYsNDk2aC00MHYxNiAgaDQwVjQ5NnogTTM3Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTQ1Niw0OTZoLTQwdjE2aDQwVjQ5NnogTTUxMiw0ODhoLTE2djhsMCwwdjE2aDE2VjQ4OHogTTUxMiw0MDhoLTE2djQwaDE2VjQwOHogTTUxMiwzMjhoLTE2djQwICBoMTZWMzI4eiBNNTEyLDI0OGgtMTZ2NDBoMTZWMjQ4eiBNNTEyLDE2OGgtMTZ2NDBoMTZWMTY4eiBNNTEyLDg4aC0xNnY0MGgxNlY4OHoiLz4KPGc+Cgk8cmVjdCB4PSIyNDQiIHk9IjE3NS45NzYiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMjQiIGhlaWdodD0iMTYwLjA4Ii8+Cgk8cmVjdCB4PSIxNzUuOTc2IiB5PSIyNDQiIHN0eWxlPSJmaWxsOiNFMjFCMUI7IiB3aWR0aD0iMTYwLjA4IiBoZWlnaHQ9IjI0Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="> Add More</span></div>'
            );
        });
        this.on('sending', function(file, xhr, formData) {
            var data = $('#previous_shows').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.image !== 'undefined') {
        name = file.image
      } else {
        name = uploadedDocumentMap[file.name]
      }
      var _ref;
      $('#previous_shows').append('<input type="hidden" name="delete_files[]" value="' + name + '">')
      $('#previous_shows').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    success: function (file, response) {
      $("#document-dropzone .dz-default").remove();
      $('#previous_shows').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
  }
</script>
@endsection
