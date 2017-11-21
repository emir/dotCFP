@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-list"></i>
                        @if (!auth()->user()->inCommittee())
                            My
                        @endif

                        @if (auth()->user()->inCommittee() && app('request')->has('status'))
                            Approved
                        @endif

                        @if (auth()->user()->inCommittee() && app('request')->has('order'))
                            Most Voted
                        @endif

                        Talks
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                @if(auth()->user()->inCommittee())
                                    <th class="col-md-1">Vote</th>
                                @endif
                                <th class="col-md-3">Title</th>
                                <th class="col-md-2">Presenter</th>
                                <th class="col-md-2">Description</th>
                                <th class="col-md-2">Additional Information</th>
                                <th class="col-md-1">Duration</th>
                                <th class="col-md-1">Created At</th>
                                @if(auth()->user()->role == 'admin')
                                    <th class="col-md-1">Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($talks as $talk)
                                <tr>
                                    @if(auth()->user()->inCommittee())
                                        <td>{{ $talk->average_vote }}</td>
                                    @endif
                                    <td>@if($talk->is_favorite)<i title="Favorite" class="fa fa-star"></i>@endif

                                        @if(auth()->user()->inCommittee())
                                            <a href="{{ route('talks.show', $talk->id) }}">{{ $talk->title }}</a>
                                        @else
                                            <a href="{{ route('talks.edit', $talk->id) }}">{{ $talk->title }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth()->user()->inCommittee())
                                            <a href="{{ route('users.show', $talk->user_id) }}" data-toggle="modal"
                                               data-target="#userModal"
                                               data-remote="false">{{ $talk->user->name }}</a>
                                        @else
                                            <a href="{{ route('users.edit', $talk->user_id) }}">{{ $talk->user->name }}</a>
                                        @endif
                                    </td>
                                    <td>{{ str_limit($talk->description, 140) }}</td>
                                    <td>{{ str_limit($talk->additional_information, 140) }}</td>
                                    <td>{{ $talk->duration }} min.</td>
                                    <td>{{ $talk->created_at->format('d-m-Y H:i') }}</td>
                                    @if(auth()->user()->role == 'admin')
                                        <td>
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="{{ route('talks.edit', $talk->id) }}"
                                                       class="btn btn-warning btn-xs">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('talks.destroy', $talk->id) }}"
                                                       class="btn btn-danger btn-xs"
                                                       onclick="return confirm('Are you sure you want to delete this talk?');">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $talks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('users.modal')

@endsection
