<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**The getVisitorIPAddress() function gets the IP-Adress
*  of Visitor as he loads the page to display his current
*  location on the map.*/
function getVisitorIPAddress(){
    $userIP =   '';
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
        $userIP =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $userIP =   $_SERVER['HTTP_X_FORWARDED_FOR'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
        $userIP =   $_SERVER['HTTP_X_FORWARDED'];
    }elseif(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])){
        $userIP =   $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        $userIP =   $_SERVER['HTTP_FORWARDED_FOR'];
    }elseif(isset($_SERVER['HTTP_FORWARDED'])){
        $userIP =   $_SERVER['HTTP_FORWARDED'];
    }elseif(isset($_SERVER['REMOTE_ADDR'])){
        $userIP =   $_SERVER['REMOTE_ADDR'];
    }else{
        $userIP =   'UNKNOWN';
    }
    return $userIP;

}


class homeController extends Controller
{
    public function prediction_view(){
        $API_KEY = "NE5OUNbZCFN4dBRshsgO0KWK4pp1dgJ6aSc3P1i9";
        $url = "https://api.nasa.gov/planetary/apod?api_key=".$API_KEY;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $value=true);
        $API_DATA = curl_exec($curl);
        $API_DATA = json_decode($API_DATA, $assoc=true);

        $ipAddress = getVisitorIPAddress();

        return view('wildfire.prediction.map');

    }

    public function prediction_view_analysis(){
        if(!isset($_POST['submit'])){
            return redirect('/map?select-location-here!');
        }
        else{
            $lat = Request('lat');
            $long = Request('long');
            $API_retreived_data = Request('API-data');
            $prediction_data = Request('prediction-data');
            $ERROR_MSG = 'Select a valid location on the map!';

            /**
             * The JSON API returned data looks like this:
             * 
             * Array ( [coord] => Array ( [lon] => 18.5 
             *                            [lat] => 17.35
             *                          )
             * 
             * [weather] => Array ( [0] => Array ( [id] => 801
             *                                     [main] =>Clouds 
             *                                     [description] => few clouds 
             *                                     [icon] => 02n
             *                                    )
             *                     )
             * 
             * [base] => stations 
             *
             * [main] => Array ( [temp] => 308.99
             *                   [feels_like] => 304.14
             *                   [temp_min] => 308.99
             *                   [temp_max] => 308.99
             *                   [pressure] => 1006
             *                   [humidity] => 13
             *                   [sea_level] => 1006
             *                   [grnd_level] => 983 
             *                  )
             * 
             * [visibility] => 10000 
             * 
             * [wind] => Array ( [speed] => 4.81
             *                   [deg] => 29 
             *                  )
             * 
             * [clouds] => Array ( [all] => 17 )
             * 
             * [dt] => 1601237017 
             * 
             * [sys] => Array ( [country] => TD
             *                  [sunrise] => 1601181337
             *                  [sunset] => 1601224686 
             *                )
             * 
             * [timezone] => 3600
             * 
             * [id] => 2432678
             * 
             * [name] => Faya-Largeau
             * 
             * [cod] => 200 )
             */
            
            if(empty($lat) || empty($long) || empty($API_retreived_data)){
                return redirect('/map')->with('ERROR_MSG', $ERROR_MSG);
            }else{
                $API_retreived_data = json_decode($API_retreived_data, $assoc=true);
                $prediction_data = json_decode($prediction_data, $assoc=true);
                return view('wildfire.prediction.view-analysis', [
                            'prediction' => round($prediction_data['pred'], 2),
                            'pred_intensity_color_class'=>$prediction_data['intensity_color'],
                            'lat'=>$lat, 
                            'long'=>$long,
                            'location_name' => $API_retreived_data['name'],
                            'temp'=>$API_retreived_data['main']['temp'],
                            'humidity'=>$API_retreived_data['main']['humidity'],
                            'wind'=>$API_retreived_data['wind']['speed']
                        ]
                );
            }
        }
    }

    public function about_us(){
        return view('about-us');
    }
}



