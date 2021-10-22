@extends('layouts.layout')

@section('content')
<center>
  <h3 id="map-title">
    WILDFIRE HOTSPOT PREDICTION <i i class="fa fa-fire" aria-hidden="true"></i>
    <br>
    <h5 id="min">on the earth map <i i class="fa fa-map" aria-hidden="true"></i> </h5>
  </h3>
</center>

<div class="row">
  <div class="container">
    <div class="justify-content-center col-lg-12">
      <center>
        <form action="/prediction/view_analysis" method="post">
          @csrf
          <input id="lat" class="input-fields" name="lat" type="number" step="0.00000000000000001"
          placeholder="latitude">

          <input id="long" class="input-fields" name="long" type="number" step="0.00000000000000001"
          placeholder="longitude">

          <input id="zoom" class="input-fields" name="zoom" type="number" placeholder="current zoom">

          <input id ="ip" name="ip-address" type="hidden" value="{{$visitorIP ?? ''}}">
          
          <input id ="API-retrieved-data" name="API-data" type="hidden">

          <input id ="prediction-data" name="prediction-data" type="hidden">
          
          <button href="/view_analysis" class="input-fields" name="submit">view analysis</button>
        </form>
        <!--progress bar-->
        <hr>
        <p class="text-danger bold">
          {{session('ERROR_MSG') ?? ''}}
        </p>
        
        <div class="progress"></div>
      </center>
    </div>
  </div>

  <!--MAP-->
  <div id="map"></div>
</div>


<!--Javascript Section-->
<script>
  //get Visitor's loacation
  async function getVisitorLocation() {
    var ip_address = document.getElementById("ip").value;
    var geoloc_API_KEY = "at_zBPNdxEZ8jcFP12F2dCOkyEAcBpQp";
    var geoloc_API_endpoint = `https://ip-geolocation.whoisxmlapi.com/api/v1?apiKey=${geoloc_API_KEY}&ipAddress=${ip_address}`;
    var response = await fetch(geoloc_API_endpoint);
    var data = await response.json()
    return ({lat: Number(data.location.lat), lng: Number(data.location.lng)})
  }


  async function initMap() {
        coordinates = await getVisitorLocation()
        var myLatlng = coordinates;

        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 4, center: myLatlng});

        // The marker, positioned at vistor's location
        var marker = new google.maps.Marker({position: myLatlng, map: map});

        // Create the initial InfoWindow.
        var infoWindow = new google.maps.InfoWindow(
            {content: 'Click the map to get Lat/Lng!', position: myLatlng});
            infoWindow.open(map);

        // Configure the click listener.
        map.addListener('click', function(mapsMouseEvent) {
          // Close the current InfoWindow.
          infoWindow.close();

          // Create a new InfoWindow.
          infoWindow = new google.maps.InfoWindow({position: mapsMouseEvent.latLng});
          infoWindow.setContent(mapsMouseEvent.latLng.toString());
          infoWindow.open(map);
          console.log(mapsMouseEvent.latLng.toString());
          document.getElementById("lat").value = mapsMouseEvent.latLng['lat']();
          document.getElementById("long").value = mapsMouseEvent.latLng['lng']();
          document.getElementById("zoom").value = map.getZoom()
        });
      }
    
</script>
<!--MAP API endpoint-->
<script defer src="https://maps.googleapis.com/maps/api/js?
key=AIzaSyC271gbhv5_lK7Y2vCfvaUooK6ySlKPgG4&callback=initMap">
</script>

<script src="js/web-prediction-script.js" defer></script>
@endsection 
