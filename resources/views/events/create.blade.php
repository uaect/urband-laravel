@extends('layouts.app', ['title' => __('Event Management')])

@section('pages_css')
<style type="text/css">
    .file {
        visibility: hidden;
        position: absolute;
    }

</style>
@endsection

@section('content')
@include('events.partials.header', ['title' => __('Add Event')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Event Management') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary"><span><i
                                        class="fas fa-arrow-left"></i></span>
                                <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('event.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Event information') }}</h6>
                        <div class="row">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('headline') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-headline">{{ __('Headline') }}</label>
                                    <input type="text" name="headline" id="input-headline"
                                        class="form-control form-control-alternative{{ $errors->has('headline') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Headline') }}" value="{{ old('headline') }}" required>

                                    @if ($errors->has('headline'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('headline') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('Location') }}</label>
                                    <input type="text" name="location" id="input-location"
                                        class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Location') }}" value="{{ old('location') }}" required>

                                    @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('date_from') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Date From') }}</label>
                                    <input type="text" name="date_from" id="input-name"
                                        class="form-control datepicker form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Date') }}" value="{{ old('date_from') }}" required
                                        autofocus>

                                    @if ($errors->has('date_from'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_from') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('date_to') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Date To') }}</label>
                                    <input type="text" name="date_to" id="input-name"
                                        class="form-control datepicker form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Date') }}" value="{{ old('date_to') }}" required autofocus>

                                    @if ($errors->has('date_to'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('time_from') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Time From') }}</label>
                                    <input type="time" name="time_from" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('time_from') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Time') }}"
                                        value="{{ old('time_from') ? old('time_from') : '00:00' }}" required autofocus>

                                    @if ($errors->has('time_from'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('time_from') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('time_to') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Time To') }}</label>
                                    <input type="time" name="time_to" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('time_to') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Time') }}"
                                        value="{{ old('time_to') ? old('time_to') : '00:00' }}" required autofocus>

                                    @if ($errors->has('time_to'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('time_to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <textarea name="description"
                                        class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Description') }}" autofocus
                                        rows="10">{{ old('description') }}</textarea>

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
                                <div class="input-group{{ $errors->has('image') ? ' has-danger' : '' }} my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload Image"
                                        id="file">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse...</button>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>Images required</strong>
                                    </span>
                                    @endif
                                <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail"
                                    style="display:none;">
                            </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Artist List</h4>
                                @if ($errors->has('addmore.*.artist'))
                                <span class="invalid-feedback" role="alert" style="display:block;">
                                    <strong>Artist is required</strong>
                                </span>
                                @endif
                                <table class="table" id="dynamicTable">
                                    <tr>
                                        <th>Artist</th>
                                        <th>Time From</th>
                                        <th>Time To</th>
                                        <th>Band Name</th>
                                        <th>Duration</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><select class="form-control" name="addmore[0][artist]" required>
                                                <option value="">Select Artist</option>
                                                @foreach($artist as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="time" name="addmore[0][from]" value="00:00"
                                                placeholder="Enter Date From" class="form-control" /></td>
                                        <td><input type="time" name="addmore[0][to]" value="00:00"
                                                placeholder="Enter Date To" class="form-control" /></td>
                                        <td><input type="text" name="addmore[0][band_name]" placeholder="Enter Band"
                                                class="form-control" /></td>
                                        <td><input type="text" name="addmore[0][duration]" placeholder="Enter Duration"
                                                class="form-control" /></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add
                                                More</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('time_from') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Tickets') }}</label>
                                    <span class="clearfix"></span>
                                    <div class="custom-control custom-radio mb-3">
                                    <input type="radio" name="tickets" class="custom-control-input" value="0" id="tickets1" onclick="show1();" checked>
                                    <label class="custom-control-label" for="tickets1">No</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                    <input type="radio" name="tickets" class="custom-control-input" value="1" id="tickets2" onclick="show2();">
                                    <label class="custom-control-label" for="tickets2">Yes</label>
                                    </div>
                                    @if ($errors->has('tickets'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tickets') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row" style="display:none;" id="packages">
                            <div class="col-md-10">
                                <h4>Packages List</h4>
                                @if ($errors->has('packages.*.package_name'))
                                <span class="invalid-feedback" role="alert" style="display:block;">
                                    <strong>Package is required</strong>
                                </span>
                                @endif
                                <table class="table" id="PackageTable">
                                    <tr>
                                        <th>Package Name</th>
                                        <th>Tickets Available</th>
                                        <th>Ticket Price</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="packages[0][package_name]"
                                                placeholder="Enter Package Name" class="form-control" /></td>
                                        <td><input type="number" name="packages[0][tickets_available]"
                                                placeholder="Enter Tickets Available" class="form-control" />
                                        </td>
                                        <td><input type="text" name="packages[0][price]" value="0.00"
                                                placeholder="Enter Ticket Price" class="form-control" /></td>
                                        <td><button type="button" name="addpackage" id="addpackage"
                                                class="btn btn-success">Add
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
<script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('argon') }}/vendor/ckeditor/ckeditor.js"></script>
<script>
function show1(){
  document.getElementById('packages').style.display ='none';
}
function show2(){
  document.getElementById('packages').style.display = 'block';
}
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    $(document).on("click", ".browse", function () {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function (e) {
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

    var i = 0;
    $("#add").click(function () {
        ++i;
        var options_str = '';
        <?php foreach($artist as $val) { ?>
                options_str += '<option value="{{$val->id}}">{{$val->name}}</option>';
        <?php } ?>
            $("#dynamicTable").append('<tr><td><select class="form-control" name="addmore[' + i + '][artist]">\
                                <option value="">Select Artist</option>\
                                ' + options_str + '\
                            </select></td>\
                            <td><input type="time" name="addmore[' + i + '][from]" value="00:00" placeholder="Enter Date From"\
                                    class="form-control" /></td>\
                            <td><input type="time" name="addmore[' + i + '][to]" value="00:00" placeholder="Enter Date To"\
                                    class="form-control" /></td>\
                            <td><input type="text" name="addmore[' + i + '][band_name]" placeholder="Enter Band"\
                                    class="form-control" /></td>\
                            <td><input type="text" name="addmore[' + i + '][duration]" placeholder="Enter Duration"\
                                    class="form-control" /></td>\
                            <td><button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">\
            Remove</button>\
            </td></tr>');
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });
    $("#addpackage").click(function () {
        ++i;
        $("#PackageTable").append(
            '<tr><td><input type="text" name="packages[' + i + '][package_name]" placeholder="Enter Package Name"\
                    class="form-control" /></td>\
            <td><input type="number" name="packages[' + i + '][tickets_available]" placeholder="Enter Tickets Available"\
                    class="form-control" /></td>\
            <td><input type="text" name="packages[' + i + '][price]" value="0.00" placeholder="Enter Ticket Price"\
                    class="form-control" /></td>\
            <td><button type="button" name="remove" id="remove-package-tr" class="btn btn-danger remove-package-tr">\
            Remove</button>\
            </td></tr>');
    });

    $(document).on('click', '.remove-package-tr', function () {
        $(this).parents('tr').remove();
    });

</script>
@endsection
