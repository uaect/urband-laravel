@extends('layouts.app', ['title' => __('About Gang')])
@section('pages_css')
<script src="{{ asset('argon') }}/css/sweetalert2.min.css"></script>
@endsection

@section('content')
    @include('about.partials.header', ['title' => __('Gang')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Gang') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('about.gang.add') }}" class="btn btn-sm btn-primary" role="button" aria-pressed="true">
                                    <span><i class="fas fa-plus"></i></span>
                                    <span class="btn-inner--text">{{ __('Add New') }}</span>
                                </a>
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
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                    @if (auth()->user()->role == 'admin')
                                    <th scope="col">{{ __('Added By') }}</th>
                                    @endif
                                    <th scope="col">{{ __('Created Date') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($abouts as $about)
                                    <tr id="item{{ $about->id }}">
                                    <td>
                                    <div class="avatar-group">
                                    <a href="javascript:void(0);" class="avatar">
                                    <img alt="Image placeholder" @if($about->image) src="/storage/{{ @$about->image }}" @else src="{{ asset('argon') }}/img/theme/no_image.png" @endif class="rounded-circle">
                                </a>
                                </div>
                                            </td>
                                        <td>{{ $about->title }}</td>
                                        @if (auth()->user()->role == 'admin')
                                        <td>{{ $about->user->name }}</td>
                                        @endif
                                        <td>{{Carbon\Carbon::parse($about->created_at)->diffForHumans()}}</td>
                                        <td>
                                            <!-- <a class="btn btn-icon btn-sm btn-success" href="{{ route('about.gang.show', $about) }}">
                                                <span><i class="far fa-eye"></i></span>
                                                <span class="btn-inner--text">{{ __('View') }}</span>
                                            </a>
                                            <a class="btn btn-icon btn-sm btn-primary" href="{{ route('about.gang.edit', $about) }}">
                                                <span><i class="far fa-edit"></i></span>
                                                <span class="btn-inner--text">{{ __('Edit') }}</span>
                                            </a> -->
                                            <a class="btn btn-icon btn-sm btn-danger remove-item" item-id="{{ $about->id }}" href="javascript:void(0);">
                                                <span><i class="far fa-trash-alt"></i></span>
                                                <span class="btn-inner--text">{{ __('Delete') }}</span>
                                            </a>
                                        </!-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $abouts->links() }}
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
<script>
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
            title: 'Removed successfully'
            })
            $.ajax({
                  type: 'POST',
                  url: '/about/destroy',
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
