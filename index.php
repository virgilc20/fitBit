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
	<ul>
		<li class="current"><a href ="profile.php">DASHBOARD</a></li>
		<li><a href ="weather.php">WEATHER</a></li>
		<li><a href ="wardrobe.php">WARDROBE</a></li>
		<li><a href ="outfits.php">OUTFITS</a></li>
		<li><a href ="profile.php">PROFILE</a></li>
	</ul>
	<div class="wrapper">
		<div>
			<div class="innercontent">
				<h1 class="header">Your Outfit Today</h1>

				<!-- This is the place where the javascript inserts the weather information -->
				<section>
			
				</section>
				

				<img src = "https://requestreduce.org/images/sun-clipart-public-domain-10.png">
			</div>
		</div>
		
	</div>
</body>
</html>