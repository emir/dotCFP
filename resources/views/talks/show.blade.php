@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                @include('flash::message')

                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-md-9">
                                <h4>@if($talk->is_favorite)<i class="fa fa-star"></i>@endif {{ $talk->title }}</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="pull-right">
                                    <div id="rate" data-score="{{ $talk->average_vote }}"
                                         data-href="{{ route('talks.vote', $talk->slug) }}" style="font-size: 8pt;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <p><strong>Description:</strong> {{ $talk->description }}</p>

                        <hr/>

                        <p><strong>Additional Information:</strong> {{ $talk->additional_information }}</p>

                        <span><i class="fa fa-user"></i> Presenter: <strong><a
                                        href="{{ route('users.show', $talk->user_id) }}"
                                        data-toggle="modal"
                                        data-target="#userModal"
                                        data-remote="false">{{ $talk->user->name }}</a></strong></span>
                        <br/>
                        <span><i class="fa fa-clock-o"></i> Duration: <strong>{{ $talk->duration }} min.</strong></span>
                        <br/>
                        @if($talk->slide)
                            <span><i class="fa fa-share"></i> Slide: <strong><a target="_blank"
                                                                                href="{{ $talk->slide }}">{{ $talk->slide }}</a></strong>
                            </span>
                        @endif
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <div class="panel-footer clearfix">
                            <div class="pull-right">
                                @if($talk->status == 0)
                                    <form method="POST" action="{{ route('talks.approve', $talk->slug) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-success pull-left"><i
                                                    class="fa fa-thumbs-o-up"></i> Approve
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('talks.approve', $talk->slug) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="status" value="0">
                                        <button type="submit" class="btn btn-danger pull-left"><i
                                                    class="fa fa-thumbs-o-down"></i> Disapprove
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                @include('talks.comments')

            </div>
        </div>
    </div>

    @include('users.modal')
@endsection
