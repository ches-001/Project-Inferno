@extends('layouts.layout')

@section('content')
<!--Some Extra Stuff-->
<div class="bg-white container row-min-height">
    <center>
        <h3 id="map-title">
            About? <i i class="fa fa-info-circle" aria-hidden="true"></i>
        </h3>
        <hr>
    </center>
    <div class="row">
        <div class="col-md-12">
            <!--About the Projecct-->
            <center>
                <h3 id="sub-map-title">
                    About This Project? <i i class="fa fa-info-circle" aria-hidden="true"></i>
                </h3>
                <hr>
            </center>
            <div class="text-panel">
                <p class="text-inverse">
                    Project Inferno is a miniature project designed to simply predict the brightness temperature of a 
                    land surface via it's longitude and latitude coordinates with the aid of Feed forward Network
                    in Deep learning.
                </p>
                <p class="text-inverse">
                    The <span class="text-primary bolder">primary aim</span> of this project is to contribute to the open source community and
                    enlighten fellow developer who are new on how machine learning models are interfaced with the webapps.
                    <br>
                    The <span class="text-inverse bolder">Secondary aim</span> is to enable the prediction of possible wildfire hotspots around the globe
                </p>
            </div>
            <hr>
            <!--About the Developer-->
            <center>
                <h3 id="sub-map-title">
                    About The Developer? <i i class="fa fa-info-circle" aria-hidden="true"></i>
                </h3>
                <hr>
            </center>

            <div class="text-panel">
                <div class="row container">
                    <div class="col-md-4">
                        <!--Profile img-->
                        <center>
                            <div class="profile-img-div">
                                <img class="profile-img" src="{{asset('/imgs/profile.jpg')}}" alt="">
                            </div>
                            <hr>
                            <p>Ches Charlemagne <i class="fa fa-user"></i></p>
                        </center>
                    </div>

                    <div class="col-md-8">
                        <p class="text-inverse">
                            The developer of the project is a machine learning enthusiat and full-stack web developer.
                            <br>
                            <a href="https://github.com/ches-001/" class="text-primary bold">Github Page. <i class="fa fa-github"></i></a>
                            <br>
                            <a href="https://discuss.pytorch.org/u/henry_chibueze/summary"  class="text-warning bold">Pytorch Page.</a>
                        </p>
                        <hr>
                        <ul>
                            <li><span class="bold text-primary">Email Address:</span> henrychibueze774@gmail.com</li>
                            <li><span class="bold text-primary">Mobile Number:</span> +2349057900367</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
