<?php

 $urlTemplate = 'http://api.ip2location.com/?' . 'ip=%s&key=demo' . '&package=WS24&format=json';
 $host= gethostname();
 $ipAddress = trim(file_get_contents("https://simplesniff.com/ip"));

 // replace the "%s" with real IP address
 $urlToCall = sprintf( $urlTemplate, $ipAddress);
 
 $rawJson = file_get_contents( $urlToCall );
 
 $geoLocation = json_decode( $rawJson, true );
 
 if(isset($geoLocation['city_name'])){
 
    if($geoLocation['city_name']!="-"){
        echo '<script language="javascript">';
        echo 'alert("Welcome Visitors from '.$geoLocation['city_name'].'")';
        echo '</script>';
    }else
    {
        echo '<center>You are in local server!</center><br>';
        echo '<script language="javascript">';
        echo 'alert("You are in local server!")';
        echo '</script>';
    }
 }else{
     echo 'IP Address parsing error!';
 }
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
    	<title>Geolocation Weather Tracker by IP</title>
  	</head>

		<body>
		<div>
		<center>Hello World!</center><br>
		</div>
		<div>
		<center>Your IP address <?php echo $ipAddress; ?></center>
		      <center>
		      <?php
		      if(isset($geoLocation['country_code'])&&isset($geoLocation['country_name'])&&isset($geoLocation['region_name'])&&isset($geoLocation['city_name'])&&isset($geoLocation['latitude'])&&isset($geoLocation['longitude'])&&isset($geoLocation['zip_code'])&&isset($geoLocation['time_zone'])){
		        echo '<br>Country Code:'."\n". $geoLocation['country_code'] . "\n<br>";
		        echo 'Country Name:'."\n". $geoLocation['country_name'] . "\n<br>";
		        echo 'Region Name:'."\n". $geoLocation['region_name'] . "\n<br>";
		        echo 'City Name:'."\n". $geoLocation['city_name'] . "\n<br>";
		        echo 'Latitude:'."\n". $geoLocation['latitude'] . "\n<br>";
		        echo 'Longitude:'."\n". $geoLocation['longitude'] . "\n<br>";
		        echo 'Zip code:'."\n". $geoLocation['zip_code'] . "\n<br>";
		        echo 'Time zone:'."\n". $geoLocation['time_zone'] . "\n<br>";
		      }else{
		          echo 'IP Address parsing error!';
		      }
		      ?>
		      </center>
		</div>

		<?php 
		
			$query = "http://api.openweathermap.org/data/2.5/weather?q=";
			$query2 = "&APPID=";
			$currentLocation = $geoLocation['city_name'].",".$geoLocation['country_name'];
			$key = "a989804cced95e7d3d909203b60503fe";

			$url = $query.$currentLocation.$query2.$key;
    		$response  = file_get_contents($url);
    		$jsonobj  = json_decode($response);			
			
		?>

		<p>
			<br/><center>Temperature: <? print_r(($jsonobj->main->temp)-273.15); ?> degrees celsius</center>
			<br/><center>Humidity: <? print_r($jsonobj->main->humidity); ?> % </center>
		</p>

	</body>
</html>