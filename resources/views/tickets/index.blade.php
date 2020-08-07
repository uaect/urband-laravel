@extends('layouts.app', ['title' => __('Event Ticket Management')])

@section('content')
    @include('tickets.partials.header', ['title' => __('Event Ticket')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Event Ticket') }}</h3>
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
                                    <th scope="col">{{ __('Event') }}</th>
                                    <th scope="col">{{ __('User') }}</th>
                                    <th scope="col">{{ __('Package') }}</th>
                                    <th scope="col">{{ __('Quantity') }}</th>
                                    <th scope="col">{{ __('Created Date') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr id="item{{ $ticket->id }}">
                                        <td>{{ $ticket->event->title }}
                                        <?php $read = getTicketRead($ticket->id);
                                            if(count($read)>0){ ?>
                                                <span class="badge badge-success">new</span>
                                            <?php } ?>
                                        </td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>{{ @$ticket->package->package_name }} - {{ @$ticket->package->price }} AED</td>
                                        <td>{{ $ticket->quantity }}</td>
                                        <td>{{ $ticket->created_at }}</td>
                                        <td><a class="btn btn-icon btn-sm btn-success" href="{{ route('tickets.show', $ticket) }}">
                                                <span><i class="far fa-eye"></i></span>
                                                <span class="btn-inner--text">{{ __('View') }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $tickets->links() }}
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
                  url: '/tickets/destroy',
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
