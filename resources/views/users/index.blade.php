@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-users"></i> Users</h4>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-hover" id="usersList">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Airport Code</th>
                                <th>Need Travel?</th>
                                <th>Need Accommodation?</th>
                                <th>Company Sponsorship?</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr href="{{ route('users.show', $user->id) }}"
                                    data-toggle="modal"
                                    data-target="#userModal"
                                    data-remote="false"
                                >
                                    <td>{{ $user->name }}</td>
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td><a target="_blank"
                                           href="https://github.com/{{ $user->username }}">{{ $user->username }}</a>
                                    </td>
                                    <td>
                                        <a target="_blank"
                                           href="https://www.google.com/flights/#search;f={{ config('dotcfp.airport_code') }};t={{ $user->airport_code }};d={{ config('dotcfp.start_date') }};r={{ config('dotcfp.end_date') }}">{{ $user->airport_code }}</a>
                                    </td>
                                    <td>{{ $user->desire_transportation ? 'yes' : 'no' }}</td>
                                    <td>{{ $user->desire_accommodation ? 'yes' : 'no' }}</td>
                                    <td>{{ $user->is_sponsor ? 'yes' : 'no' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</div>

@include('users.modal')

@endsection
