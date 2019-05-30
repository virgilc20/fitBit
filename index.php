<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Your Dashboard</title>
</head>

	<script type="text/javascript">

	    function showPosition(){
	        if(navigator.geolocation){
	            navigator.geolocation.getCurrentPosition(function(position){
	                getWeather(position.coords.latitude,position.coords.longitude);
	            });
	        } else{
	            alert("Sorry, your browser does not support HTML5 geolocation.");
	        }
	    }

	    //called to find the weather from the above function
	    function getWeather(lat, long){
	    	let stem = "http://api.openweathermap.org/data/2.5/weather?";
	    	let latitude = "lat=" + lat;
	    	let longitude = "&lon=" + long;
	    	let units = "&units=imperial";
	    	let key = "&appid=a989804cced95e7d3d909203b60503fe";
	    	let url = stem + latitude + longitude + units + key;
	    	//querys the OWM API and gets the JSON for the data
			fetch(url)
				.then(checkStatus)
				.then(JSON.parse)
				.then(handleResponse)
				.catch(console.log);    	

	    }

		/*
		   * Taken from: https://courses.cs.washington.edu/courses/cse154/19sp/resources/assets/templates/js/ajax-template-documented.js
		   * Helper function to return the response's result text if successful, otherwise
		   * returns the rejected Promise result with an error status and corresponding text
		   * @param {object} response - response to check for success/error
		   * @returns {object} - valid result text if response was successful, otherwise rejected
		   *                     Promise result
		   */
		  function checkStatus(response) {
		    if (response.status >= 200 && response.status < 300 || response.status == 0) {
		      return response.text();
		    } else {
		      return Promise.reject(new Error(response.status + ": " + response.statusText));
		    }
		  }

	    function handleResponse(data){
	    	// Parse data and display it using DOM manipulation
	    	// Overwrite HTML

	    	var sect = document.querySelector('section');

	       	var description = document.createElement('p');
			description.textContent = 'Weather Today: ' + data["weather"][0]["description"];

			var currentTemp = document.createElement('p');
			currentTemp.textContent = 'Current Temperature: ' + Math.round(data["main"]["temp"]) + "° F";
		    
			var minTemp = document.createElement('p');
			minTemp.textContent = 'Minimum Temperature: ' + Math.round(data["main"]["temp_min"]) + "°";

			var maxTemp = document.createElement('p');
			maxTemp.textContent = 'Maxium Temperature: ' + Math.round(data["main"]["temp_max"]) + "°";

			var wind = document.createElement('p');
			wind.textContent = 'Wind Speed: ' + data["wind"]["speed"] + "mph";

			var img = new Image();

			if(data["weather"][0]["description"].localeCompare('clear sky') == 0){
				img.src = 'https://st.depositphotos.com/1216158/3267/v/950/depositphotos_32676701-stock-illustration-sun-clipart.jpg';

			} else if (data["weather"][0]["description"].localeCompare('overcast clouds') == 0 || data["weather"][0]["description"].localeCompare('few clouds') == 0 || data["weather"][0]["description"].localeCompare('broken clouds') == 0 || data["weather"][0]["description"].localeCompare('scattered clouds') == 0 ) {
				img.src = 'http://images.clipartpanda.com/cloud-clip-art-rgtaylor_csc_net_wan_cloud.png';

			} else if (data["weather"][0]["description"].localeCompare('light rain') == 0 || data["weather"][0]["description"].localeCompare('moderate rain') == 0 || data["weather"][0]["description"].localeCompare('heavy intensity rain') == 0) {
				img.src = 'http://clipart-library.com/data_images/395646.png';
			
			} else if (data["weather"][0]["description"].localeCompare('snow') == 0 || data["weather"][0]["description"].localeCompare('light snow') == 0 || data["weather"][0]["description"].localeCompare('heavy snow') == 0) {
				img.src = 'https://clipartion.com/wp-content/uploads/2015/11/snow-clipart-png-file-tag-list-snow-clip-arts-file-clipartsfree.png';

			}

			img.height = 150;
			img.width = 200;

			sect.appendChild(img);
	        sect.appendChild(description);
	        sect.appendChild(currentTemp);
	        sect.appendChild(minTemp);
	        sect.appendChild(maxTemp);
	        sect.appendChild(wind);
	    }

	    showPosition();
	</script>

<body>
	<link rel="stylesheet" href = "index.css">

	<div class="topnav">
		<a class="left" href="login.php">LOGIN/LOGOUT</a>
		<a class="left" href ="profile.php">DASHBOARD</a>
    	<a class="left" href="wardrobe.php">WARDROBE</a>
  	</div>

	<div>
		<div>
			<div>
				<h1 class="header">Your Outfit Today</h1>


				<!-- This is the place where the javascript inserts the weather information -->
				<section class="weatherInfo">
			
				</section>


				<!-- The section where the outfit is displayed -->
				<div>


				</div>


			</div>
		</div>
		
	</div>
</body>
</html>