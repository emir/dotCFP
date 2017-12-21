@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            @include('flash::message')

            <div class="panel">
                <div class="panel-body">
                    <div id="slider" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @for($i = 0; $i < 5; $i++)
                                <li data-target="#slider" data-slide-to="{{ $i }}" @if($i == 0)class="active" @endif></li>
                            @endfor
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                            @for($i = 0; $i < 5; $i++)
                                <div class="item @if($i == 0)active @endif">
                                    <img src="{{ url("/images/$i.jpg") }}" alt="PHPKonf 2017" style="width:100%;">
                                </div>
                            @endfor

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#slider" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#slider" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <hr>

                    {{ $conference->description }}

                    @if(count(config('dotcfp.previous_years')) > 0)
                        <h3>Previously on {{ $conference->name }}</h3>

                        <ul class="list-unstyled">
                            @foreach(config('dotcfp.previous_years') as $last_year)
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
                    <i class="fa fa-calendar"></i> Date
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li>Submissions were accepted until <strong>{{ $conference->close_date->format('M d, Y') }}</strong></li>
                        <li>Event is <strong>{{ $conference->start_date->format('M d, Y') }}</strong></li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-map-marker"></i> Event Location
                </div>
                <div class="panel-body">
                    <div id="map"></div>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-gift"></i> Speaker Package
                </div>
                <div class="panel-body">
                    <p>
                        We know speakers are key to the success of a conference and hope
                        you will submit a talk. In appreciation of your efforts, our speaker
                        compensation package includes:
                    </p>

                    <ul>
                        @foreach(config('dotcfp.speaker_packages') as $package)
                            <li>{{ $package }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-legal"></i> Diversity Matters
                </div>
                <div class="panel-body">
                    <p>
                        {{ $conference->name }} is committed to creating a conference that is
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

@push('scripts')
<script>
function initMap() {
    var lat = parseFloat({{ $conference->lat }});
    var lng = parseFloat({{ $conference->lng }});

    var uluru = {lat: lat, lng: lng};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: uluru
    });

    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_KEY') }}&callback=initMap"></script>
@endpush
