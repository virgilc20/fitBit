<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<head>
    	<title>Weather by Location</title>
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
			currentTemp.textContent = 'Current Temperature: ' + data["main"]["temp"] + "°";
		    
			var minTemp = document.createElement('p');
			minTemp.textContent = 'Minimum Temperature today: ' + data["main"]["temp_min"] + "°";

			var maxTemp = document.createElement('p');
			maxTemp.textContent = 'Maxium Temperature: ' + data["main"]["temp_max"] + "°";

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
		<section>
			
		</section>
	</body>
</html>