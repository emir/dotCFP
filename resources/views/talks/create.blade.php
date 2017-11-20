@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                @if(empty(auth()->user()->bio))
                <div class="alert alert-danger">
                    <i class="fa fa-user"></i> Please don't forget to update your speaker profile, too!
                </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list"></i> Submit your Talk</h4>
                    </div>

                    <div class="panel-body">

                        @include('flash::message')

                        {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]])->action(route('talks.store')) !!}

                        {!! BootForm::text('Title', 'title') !!}

                        {!! BootForm::textarea('Description', 'description')->rows(3) !!}

                        {!! BootForm::textarea('Additional Information', 'additional_information')->rows(3) !!}

                        {!! BootForm::text('Duration', 'duration') !!}

                        {!! BootForm::text('Slide URL', 'slide') !!}

                        {!! BootForm::checkbox('Is this your <strong>Favorite</strong>?', 'is_favorite', 1) !!}

                        <hr/>

                        {!! BootForm::submit('Submit', 'btn-danger') !!}

                        {!! BootForm::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
