@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-pencil"></i> Edit Profile</h4>
                    </div>

                    <div class="panel-body">

                        @include('flash::message')

                        {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]])->action(route('users.update', $user->id))->put() !!}

                        {!! BootForm::bind($user) !!}

                        {!! BootForm::textarea('BIO', 'bio') !!}

                        {!! BootForm::text('Airport Code', 'airport_code') !!}

                        {!! BootForm::text('Twitter Username', 'twitter_handle') !!}

                        {!! BootForm::text('URL', 'url') !!}

                        {!! BootForm::checkbox('Desire Transportation', 'desire_transportation', 1) !!}

                        {!! BootForm::checkbox('Desire Accommodation', 'desire_accommodation', 1) !!}

                        {!! BootForm::checkbox('Is Sponsor', 'is_sponsor', 1) !!}

                        <hr/>

                        {!! BootForm::submit('Submit', 'btn-danger') !!}

                        {!! BootForm::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
