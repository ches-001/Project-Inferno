<h1>Project Inferno</h1>

<h3>DEMO VIDEO</h3>
...

<p>Project Inferno is a miniature project designed to simply predict the brightness temperature / Intensity of a land surface via it's longitude and latitude coordinates with the aid of Feed forward Network in Deep learning.</p>

<p>The <h3> primary aim </h3> of this project is to contribute to the open source community and enlighten fellow developer who are new on how machine learning models are interfaced with the webapps.
The </h3> Secondary aim </h3> is to enable the prediction of possible wildfire hotspots around the globe</p>
<hr>
<p> The model is a network of fully connected layers implimented with pytorch, It was trained on the <span style="color:blue;">fire_archive_M6_154706 dataset</span>.</p> 
<p>The trained model takes in the coordinates (longitude and latitude) of a location and outputs a brightness Intensity value in kelvins
 which is then converted to celcius</p>

<h3>Interfacing</h3>
<p>The trained model is saved as a .tar file and hosted on a flask application as a micro service</p>
<p>The flask app is interfaced with a laravel application which serves the user interface as a standalone webapp.<br>
The laravel webapp sends location coordinates data as GET request to the flask micro service endpoint and the flask api responds with
the corresponding brightness Intensity of that land location
Some other APIs were used for getting the other data pertaining to the location, like the humidity, wind speed, atmospheric temperature, etc...
</p>

<h3>Setup</h3>
<p>Clone this repository to get started.
Ensure all dependencies are installed:
<br>
<a href="">Laravel Installation guide with composer</a>
<br>
 Run the 'activate_interface_server.bat' file to fire up the laravel webapp. <br>
Next open your terminal on your working directory and run the following commands:
<ul>
<li>cd model_host_(flask-app)</li>
<li>pip install -r requirement.txt</li>
<li>python app.py</li>
</ul>
This will fire up the flask app and you are good to go.
</p>