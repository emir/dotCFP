@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @include('flash::message')

                <div class="panel">
                    <div class="panel-body">
                        <div id="flickrembed"></div>
                        <script src='https://flickrembed.com/embed_v2.js.php?source=flickr&layout=responsive&input=72157681171150484&sort=3&by=album&theme=default_notextpanel&scale=fill&limit=100&skin=default-light&autoplay=true'></script>

                        <hr>

                        <p>
                            We’re pleased to announce our conference, {{ config('opencfp.event_name', 'OpenCFP') }}
                            should be
                            one of the best PHP conferences where community members from around
                            the world come together to learn and share information about the latest
                            trends and technologies in professional PHP development.
                        </p>

                        @if(count(config('opencfp.previous_years')) > 0)
                        <h3>Previously on {{ config('opencfp.event_name') }}</h3>

                        <ul class="list-unstyled">
                            @foreach(config('opencfp.previous_years') as $last_year)
                                <li><a target="_blank" href="{{ $last_year }}">{{ $last_year }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Event Location
                    </div>
                    <div class="panel-body">
                        {!! config('opencfp.maps') !!}
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        Speaker Package
                    </div>
                    <div class="panel-body">
                        <p>
                            We know speakers are key to the success of a conference and hope
                            you will submit a talk. In appreciation of your efforts, our speaker
                            compensation package includes:
                        </p>

                        <ul>
                            @foreach(config('opencfp.speaker_packages') as $package)
                                <li>{{ $package }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        Diversity Matters
                    </div>
                    <div class="panel-body">
                        <p>
                            {{ config('opencfp.event_name', 'OpenCFP') }} is committed to creating a conference that is
                            as inclusive as
                            possible.
                            We want to showcase talent available around the U.S. and welcome international submissions
                            as well.
                        </p>
                        <p>
                            We are also committed to ensuring the conference is a place where ideas are exchanged, old
                            friends get together, new friends meet and <strong>harassment is not tolerated</strong>. We
                            expect speakers, attendees and sponsor representatives to be professional and courteous to
                            each other. We reserve the right to remove, without refund, ANY attendee (speaker or
                            otherwise) who is unable to adhere to this policy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
@endsection
