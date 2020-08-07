@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('events.partials.header', ['title' => __('Events')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Events') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary" role="button" aria-pressed="true">
                                    <span><i class="fas fa-plus"></i></span>
                                    <span class="btn-inner--text">{{ __('Add event') }}</span>
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
                                    <th scope="col">{{ __('Headline') }}</th>
                                    <th scope="col">{{ __('Event Date') }}</th>
                                    <th scope="col">{{ __('Location') }}</th>
                                    @if (auth()->user()->role == 'admin')
                                    <th scope="col">{{ __('Added By') }}</th>
                                    @endif
                                    <th scope="col">{{ __('Created Date') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                    <td>
                                    <div class="avatar-group">
                                    <a href="javascript:void(0);" class="avatar">
                                    <img alt="Image placeholder" src="storage/{{ $event->image }}" class="rounded-circle">
                                </a>
                                </div>

                                            </td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->headline }}</td>
                                        <td>{{Carbon\Carbon::parse($event->date_on)->diffForHumans()}}</td>
                                        <td>{{ $event->location }}</td>
                                        @if (auth()->user()->role == 'admin')
                                        <td>{{ $about->user->name }}</td>
                                        @endif
                                        <td>{{Carbon\Carbon::parse($event->created_at)->diffForHumans()}}</td>
                                        <td><a class="btn btn-icon btn-sm btn-success" href="{{ route('event.show', $event) }}">
                                                <span><i class="far fa-eye"></i></span>
                                                <span class="btn-inner--text">{{ __('View') }}</span>
                                            </a>
                                            <a class="btn btn-icon btn-sm btn-primary" href="{{ route('event.edit', $event) }}">
                                                <span><i class="far fa-edit"></i></span>
                                                <span class="btn-inner--text">{{ __('Edit') }}</span>
                                            </a>
                                            <a class="btn btn-icon btn-sm btn-danger" href="javascript:void(0);" onclick="confirm('{{ __("Are you sure you want to delete this event?") }}') ? this.parentElement.submit() : ''">
                                                <span><i class="far fa-trash-alt"></i></span>
                                                <span class="btn-inner--text">{{ __('Delete') }}</span>
                                            </a>
                                            <form action="{{ route('event.destroy', $event) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $events->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
