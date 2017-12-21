@extends('layouts.marketing')

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

                    lipsum org
                </div>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>

<div class="clearfix"></div>
@endsection
