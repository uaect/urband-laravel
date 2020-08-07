@extends('layouts.app', ['title' => __('Album Management')])
@section('pages_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .file,
    .browsefile {
        visibility: hidden;
        position: absolute;
    }

</style>
@endsection
@section('content')
@include('albums.partials.header', ['title' => __('Add Album')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Album Management') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('album.index') }}" class="btn btn-sm btn-primary"><span><i
                                        class="fas fa-arrow-left"></i></span>
                                <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('album.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Album information') }}</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('About') }}</label>
                                    <textarea name="description"
                                        class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('About') }}" autofocus rows="10">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('artist') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-artist">{{ __('Artist') }}</label>
                                    <select class="form-control js-example-basic-multiple form-control-alternative{{ $errors->has('artist') ? ' is-invalid' : '' }}" name="artist[]" multiple="multiple" id="input-artist">
                                        @foreach($artist as $val)
                                        <option value="{{$val->name}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('artist'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-artist">{{ __('Album Image') }}</label>
                                    <input type="file" name="image" class="file imagefile" accept="image/*">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled
                                            placeholder="Upload Album Image" id="browsefile">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Browse
                                                Image...</button>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                    <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail"
                                        style="display:none;">
                                </div>
                            </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Album Files</h4>
                                @if ($errors->has('addmore.*.artist'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>Artist is required</strong>
                                    </span>
                                    @endif
                                @if ($errors->has('addmore.*.file'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>file is required</strong>
                                    </span>
                                    @endif
                                <table class="table" id="dynamicTable">
                                    <tr>
                                        <th>Title</th>
                                        <th>Artist</th>
                                        <th>File</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="addmore[0][title]" value="{{ old('addmore[0][title]') }}" placeholder="Enter Your Title"
                                                class="form-control" />
                                        @if ($errors->has('addmore[0][title]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addmore[0][title]') }}</strong>
                                    </span>
                                    @endif</td>
                                        <td><select class="form-control" name="addmore[0][artist]">
                                        <option value="">Select Artist</option>
                                                @foreach($artist as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="file" name="addmore[0][file]" class="" accept="audio/*">
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add
                                                More</button></td>
                                    </tr>
                                </table>
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
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@section('pages_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{ asset('argon') }}/vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#add").click(function () {
        ++i;
        var options_str = '';
        <?php foreach($artist as $val) {?>
                options_str += '<option value="{{$val->id}}">{{$val->name}}</option>';
        <?php } ?>
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][title]" placeholder="Enter Your Title" class="form-control" /></td>\
                            <td><select class="form-control" name="addmore[' + i + '][artist]">\
                                <option value="">Select Artist</option>' + options_str + '</select></td>\
                            <td><input type="file" name="addmore[' + i + '][file]" class="" accept="audio/*">\
                            </td><td><button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">\
                            Remove</button>\
                            </td></tr>');
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });

    $(document).on("click", ".browse", function () {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('.imagefile').change(function (e) {
        var fileName = e.target.files[0].name;
        $('#preview').fadeIn('200');
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
