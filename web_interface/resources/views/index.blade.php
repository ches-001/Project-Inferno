@extends('layouts.layout')

@section('content')
<div id="bg-index">
    <!--bg-contents-->
    <div class="container">
        <center>
            <h1 id="map-title"><p> <i class="fa fa-fire"> </i> INFERNO</p></h1>
            <hr>
        </center>
        <p class="bg-text">
            A Miniature Project on the use of Deep Learning <br>
            in the prediction of brightness Temperature of land surfaces.
        </p>
        <hr>
        <p class="bolder text">By Ches</p>
        <center>
            <ul class="list-inline">
                <li><a href="{{route('/map')}}" class="btn link-box"><p class="text">Map</p></a></li>
                <li><a href="{{route('/about_us')}}" class="btn link-box"><p class="text">About</p></a></li>
            </ul>
        </center>
    </div>
</div>

<div class="bg-white row-min-height">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h1 class="">Project Inferno.</h1>
                    <hr>
                    <div class="text-panel">
                        <p class="text-inverse">
                            A miniature project designed to simply predict the brightness temperature of a 
                            land surface via it's longitude and latitude coordinates with the aid of Feed forward Network
                            in <span class="bolder">Deep learning</span>.
                        </p>
                        <br>
                        <hr>
                        <div class="col-md-12">
                            <ul class="list-inline">
                                <li>
                                    <img class="disp-idea-img" src="{{asset('/imgs/ml_algorithm.jpg')}}" alt="">
                                    <p class="mini-text-inverse bolder">Machine Learning</p>
                                </li>

                                <li><span id="big-arithmetic-sign"> + </span></li>

                                <li>
                                    <img class="disp-idea-img" src="{{asset('/imgs/dataset.jpg')}}" alt="">
                                    <p class="mini-text-inverse bolder">Data</p>
                                </li>

                                <li><span id="big-arithmetic-sign"> = </span></li>

                                <li>
                                    <img class="disp-idea-img" src="{{asset('/imgs/solution.jpg')}}" alt="">
                                    <p class="mini-text-inverse bolder">Solution</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection







