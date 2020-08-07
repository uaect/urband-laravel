@extends('layouts.app', ['title' => __('Pages')])
@section('pages_css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
    <style type="text/css">
    .change-title{
        cursor: pointer !important;
    }
    </style>
@endsection

@section('content')
@include('about.partials.header', ['title' => __('Pages')])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Website Pages') }}</h3>
                            @if (session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Page') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                            <tr>
                                <td>
                                    <div style="display: none;" class="col-md-3 title" id="title{{ $page->id }}">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}  mt-2">
                                            <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                            <input type="text" name="title"
                                                class="form-control titlevalue{{ $page->id }}"
                                                placeholder="{{ __('Title') }}" value="{{ $page->title }}" autofocus>
                                            <button type="button" class="btn btn-success btn-sm mt-2 update-title"
                                                item-id="{{ $page->id }}"><span><i
                                                        class="fas fa-cloud-upload-alt"></i></span>
                                                <span class="btn-inner--text">{{ __('Save') }}</span></button>
                                            <button type="button" class="btn btn-danger btn-sm mt-2 cancel-title"><span><i
                                                        class="fas fa-sign-out-alt"></i></span>
                                                <span class="btn-inner--text">{{ __('Cancel') }}</span></button></div>
                                    </div>
                                    <h5 class="change-title title{{ $page->id }}" item-id="{{ $page->id }}">
                                        {{ $page->title }}<span>&nbsp;&nbsp;<i class="fas fa-edit"></i></span>
                                                <span class="btn-inner--text"></span></h5>
                                </td>
                                <td>
                                    <label item-id={{ $page->id }} class="custom-toggle change-status">
                                        <input type="checkbox" @if($page->status==1) checked @endif data-on="Enabled"
                                        data-off="Disabled" data-toggle="toggle" data-onstyle="outline-success"
                                        data-offstyle="outline-danger">
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $pages->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@section('pages_js')
<script src="{{ asset('argon') }}/js/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    $(document).on('click', '.change-status', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var item_id = $(this).attr('item-id');
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
            title: 'Updated successfully'
        })
        $.ajax({
            type: 'POST',
            url: '/pages/change_status',
            method: 'POST',
            headers: {
                'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0]
                    .getAttributeNode('content').value,
            },
            data: {
                item_id: item_id
            },
        });
    });
    $(document).on('click', '.change-title', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var item_id = $(this).attr('item-id');
        var title = $(this).attr('item-id');
        $('.title').hide();
        $('.change-title').show();
        $('.title' + item_id).hide();
        $('#title' + item_id).fadeIn('200');
    });
    $(document).on('click', '.cancel-title', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('.title').hide();
        $('.change-title').fadeIn('200');
    });
    $(document).on('click', '.update-title', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var item_id = $(this).attr('item-id');
        var title_value = $('.titlevalue' + item_id).val();
        $('#title' + item_id).hide();
        $('.title' + item_id).html(title_value+'<span>&nbsp;&nbsp;<i class="fas fa-edit"></i></span><span class="btn-inner--text"></span>');
        $('.title' + item_id).fadeIn('200');
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
            title: 'Updated successfully'
        })
        $.ajax({
            type: 'POST',
            url: '/pages/change_status',
            method: 'POST',
            headers: {
                'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0]
                    .getAttributeNode('content').value,
            },
            data: {
                item_id: item_id,
                title_value: title_value
            },
        });
    });

</script>
@endsection
