@extends('layouts.layout')

@section('content')
<!--Some Extra Stuff-->
<center>
  <h3 id="map-title">
    VIEW LOCATION DATA AND PREDICTION <i i class="fa fa-bar-chart" aria-hidden="true"></i>
  </h3>
</center>

<div id="a-view">
<br>
<br>
<div class="container row-min-height">
    <div class="row">
        <button class="btn-dark hidden visible-xs" type="button" data-toggle="collapse" data-target="#ancillary-data">
        <i class="fa fa-bars"></i> Location details
        </button>
        <div class="col-md-8 collapse dont-collapse-sm" id="ancillary-data">
            <div class="row">
                <h3 class="milky-title">Feature Details</h3>
                <hr>
                <div class="col-md-4 right-border">
                    <p class="text">Location Name: </p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$location_name}}</p></div>
                    <br>
                    <p class="text">Latitude: </p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$lat}}</p></div>
                    <br>
                    <p class="text">longitude: </p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$long}}</p></div>
                    <br>
                    <p class="text">Temperature of atmosphere: </p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$temp}} Kelvins</p></div>
                    <br>
                </div>

                <div class="col-md-4">
                    <p class="text">Humidity: </p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$humidity}}</p></div>
                    <br>
                    <p class="text">Wind Speed: </p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$wind}}</p></div>
                </div>
            </div>
        </div>

        <div class="col-md-4" id="prediction">
            <h3 class="milky-title">Model Predictions</h3>
            <hr>
            <p class="text">Predicted Brightness Intensity:</p><div class="breadcrumb breadcrumb-dim"><p class="text">{{$prediction}} Celsius</p></div>
            <div class="progress">
                <div class="progress-bar {{$pred_intensity_color_class}}" style="width:{{$prediction}}%;height:100px;">
                    {{$prediction}} Celsius
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
</div>
@endsection
