@extends('layouts.app', ['title' => __('Album Management')])

@section('pages_css')
<style type="text/css">
.file {
  visibility: hidden;
  position: absolute;
}
</style>
@endsection
@section('content')
    @include('albums.partials.header', ['title' => __('Edit Album')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Album Management') }}</h3>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div>{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('album.index') }}" class="btn btn-sm btn-primary"><span><i class="fas fa-arrow-left"></i></span>
                                    <span class="btn-inner--text">{{ __('Back to list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('album.update', $album) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Album information') }}</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Title') }}" value="{{ old('title', $album->title) }}" required autofocus>

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
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <textarea name="description"
                                        class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Description') }}" autofocus rows="10">{{ old('description', $album->description) }}</textarea>

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
                            <?php if(@$album) { ?>
                                <img src="<?php if(@$album->image) {?>/storage/{{ @$album->contentImage() }}<?php } ?>" id="preview" class="img-thumbnail">
                                <?php } ?>
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
                                    <?php if(count(@$album->tracks)>0){ $i = 0; foreach(@$album->tracks as $list){ ?>
                                        <tr id="item{{ $list->id }}">
                                        <td>{{$list->title}}</td>
                                        <td>@foreach($artist as $val)
                                             {{($list->artist_id==$val->id)?$val->name:''}}
                                             @endforeach
                                        <td><audio controls>
                                        <source src="horse.ogg" type="audio/ogg">
                                        <source src="/storage/{{$list->file}}" type="audio/mpeg">
                                        Your browser does not support the audio tag.
                                        </audio></td>
                                        <td><button type="button" name="remove" item-id="{{ $list->id }}" class="btn btn-danger remove-item">Remove</button></td>
                                    </tr>
                                    <?php $i++; }} ?>
                                        <tr>
                                        <td><input type="text" name="addmore[0][title]" placeholder="Enter Your Title"
                                                class="form-control" /></td>
                                        <td><select class="form-control" name="addmore[0][artist]">
                                        <option value="">Select Artist</option>
                                                @foreach($artist as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="file" name="addmore[0][file]" class="" accept="audio/*">
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                    </tr>
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
<script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('argon') }}/vendor/ckeditor/ckeditor.js"></script>
<script src="{{ asset('argon') }}/js/sweetalert2.all.min.js"></script>
<script>
    <?php if(count(@$album->tracks)>0){ ?>
        var i = <?php echo count(@$album->tracks)-1; ?>;
    <?php }else{ ?>
        var i = 0;
    <?php }?>
    $("#add").click(function () {
        ++i;
        var options_str = '';
        <?php foreach($artist as $val) {?>
                options_str += '<option value="{{$val->id}}">{{$val->name}}</option>';
        <?php } ?>
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][title]" placeholder="Enter Your Title" class="form-control" /></td>\
                            <td><select class="form-control" name="addmore[' + i + '][artist]">\
                                <option value="">Select Artist</option>' + options_str + '</select></td>\
                            <td><input type="file" name="addmore[' + i + '][file]" class="" accept="image/*">\
                            </td><td><button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">\
                            Remove</button>\
                            </td></tr>');
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });
$('.datepicker').datepicker({
    format:  'yyyy-mm-dd',
    autoclose: true
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
$(document).on('click', '.remove-item', function(e) {
      e.preventDefault();
      e.stopPropagation();
      var item_id = $(this).attr('item-id');
      Swal.fire({
          title: 'Remove item?',
          text: "Are you sure you want to remove this item?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, remove it!',
          cancelButtonText: 'No',
        }).then((result) => {
          if (result.value) {
            const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            width: '100%',
            showConfirmButton: false,
            customClass: 'swal-wide',
            timer: 3000
            });

            Toast.fire({
            type: 'success',
            title: 'Removed successfullyaudio/file_example_MP3_5MG.mp3'
            })
            $.ajax({
                  type: 'POST',
                  url: '/album/destroyfile',
                  method: 'POST',
                  headers: {
                   'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
                  },
                  data: {item_id:item_id},
                  success: function(data) {
                  $("#item"+item_id).remove();
                  },
            });
          }
      })
});
</script>
@endsection
