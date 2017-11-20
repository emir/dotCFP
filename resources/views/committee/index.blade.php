@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-users"></i> Committee</h4>
                </div>

                <div class="panel-body">

                    <div class="alert alert-info">
                        <strong>Would like to be part of committee?</strong> Shoot us an <a href="mailto:{{ config('opencfp.event_email') }}">email</a>!
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>BIO</th>
                                <th><i class="fa fa-github"></i></th>
                                <th><i class="fa fa-twitter"></i></th>
                                <th><i class="fa fa-rss"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><img class="img-circle" width="70px" src="{{ $user->avatar }}" alt="{{ $user->name }}"/></td>
                                    <td>{{ $user->name }} <i>({{ $user->role == 'admin' ? 'Organizer' : 'Reviewer' }})</i></td>
                                    <td>@if($user->bio){{ $user->bio }}@else N/A @endif</td>
                                    <td><a target="_blank" href="https://github.com/{{ $user->username }}">{{ $user->username }}</a></td>
                                    <td>@if($user->twitter_handle)<a target="_blank" href="https://twitter.com/{{ $user->twitter_handle }}">{{ $user->twitter_handle }}</a>@else N/A @endif</td>
                                    <td>@if($user->url)<a target="_blank" href="{{ $user->url }}">{{ $user->url }}</a>@else N/A @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
