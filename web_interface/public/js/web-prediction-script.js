/**This block checks for click events on the map */
var map = document.querySelector("#map");
map.addEventListener("click", () => {
    passLatLong()
});


/** The 'passLatLong()' function gets the geo-coordinates of the clicked
 *  area in the map and passes this coordinates to the 'getWeatherStat()'
 * function to get the 'onwater' and 'weather' status of location via an API
 */
function passLatLong() {
    var currentLat = document.getElementById("lat").value;
    var currentLong = document.getElementById("long").value;
    if (currentLat.length != 0 || currentLong.length != 0) {
        //weather api reqest
        getWeatherStat(currentLat, currentLong)
    }
}

/**The 'getWeatherStat(*args)' function sends request to two endpoints  
 * It sends a request to 'api.onwater.io' to check if coordinates are
 * on water or on land, the feedback of this resquest is a json object.
 * Given that wild fire does not occur on water bodies, if 
 * the 'water' key of the json object is 'true' it reutrns a warning 
 * informing that 'wildfire cannot be predicted over a water body',
 * and when returns 'false' it sends a resquest to 'openweathermap.org'
 * endpoint with geo-coordinates as url parameters to get the current 
 * weather condition and other details of that location, which is then
 * passed to the 'queryModel()' function as data of features to 
 * the learning model.
 */
async function getWeatherStat(lat, long) {
    //checks if coordinates of location is water or land
    var onWater_API_KEY = "UFVBXbyPrStt_o2Ed6Wg";
    var onWater_API_endpoint = `https://api.onwater.io/api/v1/results/${lat},${long}?access_token=${onWater_API_KEY}`;
    var onWater_API_response = await fetch(onWater_API_endpoint)
    var stat = await onWater_API_response.json()
    var on_water = stat.water;

    if (on_water == false) {
        var WEATHER_API_KEY = "98cfff369eb8521e5a9e3158b6efd175";
        var WEATHER_API_endpoint = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=${WEATHER_API_KEY}`;
        var WEATHER_API_endpoint_response = await fetch(WEATHER_API_endpoint);
        var data = await WEATHER_API_endpoint_response.json();
        data = JSON.stringify(data);
        document.getElementById("API-retrieved-data").value = data;
        queryModel(lat, long, data);

    } else {
        document.querySelector(".progress").innerHTML = (
            `<div class="progress-bar" style="width:; height:100px;"></div>`
        );
        document.querySelector(".text-danger").innerHTML = (
            `<i class='fa fa-warning'></i>"CANNOT PREDICT WILDFIRE OVER WATER BODY."`
        );
        document.getElementById("API-retrieved-data").value = null;
    }
}


/**The 'queryModel(*args) function takes in 'latitude', 'longitude' 
 * and 'weather_data' as arguments to be used as features for the machine
 * learning model which will be used to make predictions. 
 * The machine learning model is hosted on a seperate domain and served on a flask server.
 * The fuction sends a request to the model domain with the function parameter as
 * url parameters the model takes these url parameters as features and makes a
 * prediction with them.
 * The prediction is sent back as a json response from model domain back to the
 * client side domain which in turn displays the prediction on the webpage.*/

async function queryModel(lat, long, weather_data) {
    //get prediction from the Machine Learning Model
    var m_l_model_API_endpoint = `http://127.0.0.1:5000/get_BT?lat=${lat}&long=${long}`;
    var response = await fetch(m_l_model_API_endpoint);
    var ml_data = await response.json();
    var prediction = ml_data.model_prediction;

    /**prediction intensity as color mapping*/
    var pred_color_class = colorIntensityBarClass(prediction.toFixed(0));
    var prediction_data = { pred: prediction, intensity_color: pred_color_class };
    document.getElementById("prediction-data").value = JSON.stringify(prediction_data);


    /**This block puts model prediction and color intensity
     * in a hidden input field which will be passed to backend
     * to display to the 'view_analysis' page when loaded
     */
    document.querySelector(".progress").innerHTML = (
        `<div class="progress-bar ${pred_color_class}" style="width:${prediction.toFixed(0)}%;height:100px;">
            ${prediction.toFixed(2)} Celsius
        </div>`);
    document.querySelector(".text-danger").innerHTML = ("");
}

/**colorIntensityBarClass(*arg) takes in the prediction of the model as parameter,
 * this function assigns color specific features to intensity bar based on the
 * percentile it falls under and returns a string which will be used as style 
 * class for the bar HTML.
 */
function colorIntensityBarClass(prediction) {
    if (prediction >= 0 && prediction <= 25) {
        return "first-percentile";
    } else if (prediction >= 26 && prediction <= 50) {
        return "second-percentile";
    } else if (prediction >= 51 && prediction <= 75) {
        return "third-percentile";
    } else if (prediction >= 76 && prediction <= 100) {
        return "fourth-percentile";
    }
}