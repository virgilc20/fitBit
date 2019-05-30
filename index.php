<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Your Dashboard</title>
</head>
<body>
	<link rel="stylesheet" href = "index.css">

	<div class="topnav">
		<a class="left" href ="index.php">DASHBOARD</a>
    	<a class="left" href="wardrobe.php">WARDROBE</a>
    	<a class="left" href="login.php"> <?php echo "("; echo $_SESSION['userUid']; echo ") ";?>LOGIN/LOGOUT</a>
  	</div>

	<div>
		<div>
			<div>
				<h1 class="header">Your Outfit Today</h1>


				<!-- This is the place where the javascript inserts the weather information -->
				<section class="weatherInfo">
			
				</section>


				<!-- The section where the outfit is displayed -->
				<div id = "fit1">

				</div>
				<div id = "fit2">

				</div>
				<div id = "fit3">


				</div>
			</div>
		</div>
		
	</div>
</body>
	<script type="text/javascript">
		var temperature = 55;

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
		    
			temperature = Math.round(data["main"]["temp"]);
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

	    //Outfits
	    //modified from https://stackoverflow.com/questions/46432335/hex-to-hsl-convert-javascript
		function hexToHSL(hexCode)
		{
			var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hexCode);
		    var r = parseInt(result[1], 16);
		    var g = parseInt(result[2], 16);
		    var b = parseInt(result[3], 16);
	    	r /= 255, g /= 255, b /= 255;
	    	var max = Math.max(r, g, b), min = Math.min(r, g, b);
	    	var h, s, l = (max + min) / 2;

	    	if(max == min)
	    	{
	    	    h = s = 0; // achromatic
	   		}
	   		else 
	   		{
	        	var d = max - min;
	        	s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
	        	switch(max) 
	        	{
	            	case r: h = (g - b) / d + (g < b ? 6 : 0); break;
	        	    case g: h = (b - r) / d + 2; break;
	        	    case b: h = (r - g) / d + 4; break;
	        	}
	        	h *= 60 ;
			}
			return([h,s,l]);

		}
		function loadClothes()
		{
			var wardrobe = [];
			var desiredFormality = 2;
			var colorRelationship = "";		
			<?php
				require("includes/dbh.inc.php");
					// $res = mysqli_query($conn, "SELECT 'pjiang_litfit_wardrobe.id', 'pjiang_litfit_wardrobe.color', 'pjiang_litfit_attire_list.type', 'pjiang_litfit_attire_list.subtype', 'pjiang_litfit_attire_list.subsubtype', 'pjiang_litfit_attire_list.weight', 'pjiang_litfit_attire_list.formality',FROM 'pjiang_litfit_wardrobe' LEFT JOIN 'pjiang_litfit_attire_list' ON 'pjiang_litfit_wardrobe.attireid' = 'pjiang_litfit_attire_list.id' ORDER BY 'pjiang_litfit_attire_list.id'");
				
				$sql =  "SELECT pjiang_litfit_wardrobe.wardrobeId, pjiang_litfit_wardrobe.color, pjiang_litfit_attire_list.type, pjiang_litfit_attire_list.subtype, pjiang_litfit_attire_list.subsubtype, pjiang_litfit_attire_list.weight, pjiang_litfit_attire_list.formality FROM pjiang_litfit_wardrobe LEFT JOIN pjiang_litfit_attire_list ON pjiang_litfit_wardrobe.attireid = pjiang_litfit_attire_list.id LEFT JOIN pjiang_litfit_users ON pjiang_litfit_wardrobe.userId = pjiang_litfit_users.idUsers WHERE pjiang_litfit_wardrobe.userId = ". $_SESSION['userId'];
				$result = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($result))
				{

					echo "wardrobe.push({id : " . $row['wardrobeId'] . ", colorHsl : [], colorHex :'" . $row['color'] . "', type :'" . $row['type'] . "', subtype :'" . $row['subtype'] . "', subsubtype :'" . $row['subsubtype'] . "', weight :'" . $row['weight'] . "', formality :" . $row['formality'] . "}); \n";
				}	
			?>
			for (var i = wardrobe.length-1; i >= 0; i--) {
				wardrobe[i].colorHsl = hexToHSL(wardrobe[i].colorHex);
			}
			var outfits = [];
			outfits.push(getAcro(wardrobe));
			outfits.push(getMono(wardrobe));
			outfits.push(getComp(wardrobe));
			var outfit1 = [];
			outfit1.push('<tr>');
			if(outfits[0].jacket != null)
			{
				outfit1.push('<p>' + outfits[0].jacket.subsubtype + '</td>' + '<td> (' + outfits[0].jacket.subtype + ') </td>','<td style = color:'+ outfits[0].jacket.colorHex + '>'+ outfits[0].jacket.colorHex + '</td> </p> <p>');

			}	
			if(outfits[0].sweater != null)
			{
				outfit1.push('<td>' + outfits[0].sweater.subsubtype + '</td>' + '<td> (' + outfits[0].sweater.subtype + ') </td>','<td style = color:' + outfits[0].sweater.colorHex + '>'+ outfits[0].sweater.colorHex + '</td> </p> <p>');

			}
			if(outfits[0].shirt != null)
			{
				outfit1.push('<td>' + outfits[0].shirt.subsubtype + '</td>' + '<td> (' + outfits[0].shirt.subtype + ') </td>','<td style = color:' +  outfits[0].shirt.colorHex + '>'+ outfits[0].shirt.colorHex + '</td></p> <p>');

			}
			outfit1.push('<td>' + outfits[0].pants.subsubtype + '</td>' + '<td> (' + outfits[0].pants.subtype + ') </td>','<td style = color:' + outfits[0].pants.colorHex + '>'+ outfits[0].pants.colorHex + '</td></p> <p>');
			outfit1.push('<td>' + outfits[0].shoes.subsubtype + '</td>' + '<td> (' + outfits[0].shoes.subtype + ') </td>','<td style = color:' + outfits[0].shoes.colorHex + '>'+ outfits[0].shoes.colorHex + '</td></p> <p>');

			var outfit2 = [];
			outfit2.push('<tr>');
			if(outfits[1].jacket != null)
			{
				outfit2.push('<td>' + outfits[1].jacket.subsubtype + '</td>' + '<td> (' + outfits[1].jacket.subtype + ') </td>','<td style = color:' + outfits[1].jacket.colorHex + '>'+ outfits[1].jacket.colorHex + '</td></p> <p>');

			}	
			if(outfits[1].sweater != null)
			{
				outfit2.push('<td>' + outfits[1].sweater.subsubtype + '</td>' + '<td> (' + outfits[1].sweater.subtype + ') </td>','<td style = color:' + outfits[1].sweater.colorHex + '>'+ outfits[1].sweater.colorHex + '</td></p> <p>');

			}
			if(outfits[1].shirt != null)
			{
				outfit2.push('<td>' + outfits[1].shirt.subsubtype + '</td>' + '<td> (' + outfits[1].shirt.subtype + ') </td>','<td style = color:' + outfits[1].shirt.colorHex + '>'+ outfits[1].shirt.colorHex + '</td></p> <p>');

			}
			outfit2.push('<td>' + outfits[1].pants.subsubtype + '</td>' + '<td> (' + outfits[1].pants.subtype + ') </td>','<td style = color:' + outfits[1].pants.colorHex + '>'+ outfits[1].pants.colorHex + '</td></p> <p>');
			outfit2.push('<td>' + outfits[1].shoes.subsubtype + '</td>' + '<td> (' + outfits[1].shoes.subtype + ') </td>','<td style = color:' + outfits[1].shoes.colorHex + '>'+ outfits[1].shoes.colorHex + '</td></p> <p>');

			var outfit3 = [];
			outfit3.push('<tr>');
			if(outfits[2].jacket != null)
			{
				outfit3.push('<td>' + outfits[2].jacket.subsubtype + '</td>','<td> (' + outfits[2].jacket.subtype + ') </td>','<td style = color:' + outfits[2].jacket.colorHex + '>'+ outfits[2].jacket.colorHex + '</td></p> <p>');

			}	
			if(outfits[2].sweater != null)
			{
				outfit3.push('<td>' + outfits[2].sweater.subsubtype + '</td>' + '<td> (' + outfits[2].sweater.subtype + ') </td>','<td style = color:' + outfits[2].sweater.colorHex + '>'+ outfits[2].sweater.colorHex + '</td></p> <p>');

			}
			if(outfits[2].shirt != null)
			{
				outfit3.push('<td>' + outfits[2].shirt.subsubtype + '</td>' + '<td> (' + outfits[2].shirt.subtype + ') </td>','<td style = color:' + outfits[2].shirt.colorHex + '>'+ outfits[2].shirt.colorHex + '</td>');

			}
			outfit3.push('<td>' + outfits[2].pants.subsubtype + '</td>' + '<td> (' + outfits[2].pants.subtype + ') </td>','<td style = color:' + outfits[2].pants.colorHex + '>'+ outfits[2].pants.colorHex + '</td></p> <p>')
			outfit3.push('<td>' + outfits[2].shoes.subsubtype + '</td>' + '<td> (' + outfits[2].shoes.subtype + ') </td>','<td style = color:' + outfits[2].shoes.colorHex + '>'+ outfits[2].shoes.colorHex + '</td></p> <p>');
			var htmlString1 = outfit1.join('');
			var htmlString2 = outfit2.join('');
			var htmlString3 = outfit3.join('');
			var element1 = document.getElementById('fit1');
			var element2 = document.getElementById('fit2');
			var element3 = document.getElementById('fit3');
			element1.innerHTML = htmlString1;
			element2.innerHTML = htmlString2;
			element3.innerHTML = htmlString3;
		}
		function getDesiredClothesTypes()
		{
			var outfitTemplate = {jacket:null, sweater:false, shirt:null, pants: false, shoes:true};
			var jacketWeight = Math.random();
			var topWeight = Math.random();
			var pantWeight = Math.random();
			var shoeWeight = Math.random();
			if(temperature > 80)
			{
				outfitTemplate[2] = "short";
				if (jacketWeight > 0.5)
				{
					outfitTemplate.jacket = "Light";
				}
				if (pantWeight > 0.5)
				{
					outfitTemplate.pants = true;
				}
			}
			else if (temperature > 60)
			{

					if(jacketWeight > 6/7)
					{
						outfitTemplate.jacket = "Medium";
						outfitTemplate.shirt = "short";
						outfitTemplate.pants = true;
					}
					else if (jacketWeight > 2/7)
					{
						outfitTemplate.jacket = "Light";
						if(topWeight > 0.75)
						{
							outfitTemplate.sweater = true;
							outfitTemplate.pants = true;
						}
						else if (topWeight > 0.5)
						{
							outfitTemplate.shirt = "long";
						}
						else
						{
							outfitTemplate.shirt = "short";
							if(pantWeight > 0.5)
							{
								outfitTemplate.pants = true;
							}
						}
					}
					else
					{
						outfitTemplate.pants = true; 
						if(topWeight > 0.5)
						{
							outfitTemplate.sweater = true;
						}
					}
			}
			else if (temperature > 50)
			{
				outfitTemplate.pants = true;
				if (jacketWeight > 2/3)
				{
					outfitTemplate.jacket = "Medium";
					if(topWeight > 2/3)
					{
						outfitTemplate.sweater = true;
					}
					else if (topWeight > 1/3)
					{
						outfitTemplate.shirt = "long";
					}
					else
					{
						outfitTemplate.shirt = "short";
					}
				}
				else if(jacketWeight > 1/3)
				{
					outfitTemplate.jacket = "Light";
					if(topWeight > 2/3)
					{
						outfitTemplate.sweater = true;
					}
					else if(topWeight > 1/3)
					{
						outfitTemplate.shirt = "long";
					}
					else
					{
						outfitTemplate.shirt = "short";
					}
				}
				else
				{
					if(topWeight > 1/3)
					{
						outfitTemplate.sweater = true;
					}
					if (topWeight < 2/3)
					{
						outfitTemplate.shirt = "long";
					}
				}
			}
			else if (temperature > 32)
			{
				outfitTemplate.pants = true;
				if(jacketWeight > 2/3)
				{
					outfitTemplate.jacket = "Heavy";
					if(topWeight > 0.5)
					{
						outfitTemplate.sweater = true;
					}
					else
					{
						outfitTemplate.shirt = "long"
					}
				}
				else if(jacketWeight > 1/6)
				{
					outfitTemplate.jacket = "Medium";
					if(topWeight > 1/3)
					{
						outfitTemplate.sweater = true;
					}
					if(topWeight < 2/3)
					{
						outfitTemplate.shirt = "long"
					}
				}
				else
				{
					outfitTemplate.jacket = "Light";
					outfitTemplate.sweater = true;
					outfitTemplate.shirt = "long";
				}
			}
			else
			{
				outfitTemplate.pants = true;
				if(jacketWeight > 1/2)
				{
					outfitTemplate.jacketWeight = "Heavy";

				}
				else
				{
					outfitTemplate.jacketWeight = "Medium";
				}
				if(topWeight > 1/3)
					{
						outfitTemplate.sweater = true;
					}
				if(topWeight < 2/3)
				{
					outfitTemplate.shirt = "long"
				}
			}
			if(outfitTemplate.pants && shoeWeight < Math.pow(1-temperature, 1.5))
			{
				outfitTemplate.shoes = false;
			}
			return outfitTemplate;
		}
		function trimWardrobe(wardrobe, outfitTemplate, formality)
		{ 
			var goodClothes = [];
			for(var i = 0; i < wardrobe.length; i++)
			{
				goodClothes[i] = wardrobe[i];
			}
			for(var i = 0; i< goodClothes.length; i++)
			{
				if(goodClothes[i].formality < formality-1 || goodClothes[i].formality > formality+1)
				{
					goodClothes.splice(i,1);
					i--;
				}
				else if(goodClothes[i].subtype == "Jacket")
				{
					if(outfitTemplate.jacket == null || outfitTemplate.jacket != goodClothes[i].weight)
					{
						goodClothes.splice(i,1);
						i--;
					}
				}
				else if(goodClothes[i].subtype == "Shirt")
				{
					if(outfitTemplate.shirt == null)
					{
						goodClothes.splice(i,1);
						i--;
					}
					else if(outfitTemplate.shirt == "long")
					{
						if(goodClothes[i].subsubtype == "Short-sleeve Tee" || goodClothes[i].subsubtype == "Polo" || goodClothes[i].subsubtype == "Short-sleeve Button-down")
						{
							goodClothes.splice(i,1);
							i--;
						}
					}
					else
					{
						if(goodClothes[i].subsubtype == "Long-sleeve Tee" || goodClothes[i].subsubtype == "Long-sleeve Button-down")
						{
							goodClothes.splice(i,1);
							i--;
						}
					}
				}
				else if(goodClothes[i].subtype == "Sweater")
				{
					if(outfitTemplate.sweater == false)
					{
						goodClothes.splice(i,1);
						i--;
					}
				}
				else if(goodClothes[i].type == "Bottom")
				{
					if((goodClothes[i].subtype == "Pants") != outfitTemplate.pants)
					{
						goodClothes.splice(i,1);
						i--;
					}
				}
				else if(goodClothes[i].type == "Footwear")
				{
					if((outfitTemplate.shoes) != (goodClothes[i].subtype == "Sneakers"))
					{
						goodClothes.splice(i,1);
						i--;
					}
				}
			}
			return goodClothes;
		}
		function getAcro(wardrobe)
		{
			
			var success = false;
			var iterations = 0;
			while(!success && iterations < 100)
			{
				iterations++;
				success = true;
				outfitTemplate = getDesiredClothesTypes();
				//console.log(outfitTemplate);
				clothes = trimWardrobe(wardrobe, outfitTemplate, 2);
				var jackets = [];
				var sweaters = [];
				var shirts = [];
				var pants = [];
				var shoes = [];
				var outfit = {jacket: null, sweater: null, shirt: null, pants: null, shoes: null}; 
				for(var i = clothes.length-1; i>=0; i--)
				{
					if(clothes[i].colorHsl[1] < .08 || clothes[i].colorHsl[2] < .1 || clothes[i].colorHsl[2] > .96)
					{

						if(clothes[i].subtype == "Jacket")
						{
							jackets.push(clothes[i]);
						}
						else if(clothes[i].subtype == "Sweater")
						{
							sweaters.push(clothes[i]);
						}
						else if(clothes[i].type == "Top")
						{
							pants.push(clothes[i]);
						}
						else if(clothes[i].type == "Bottom")
						{
							pants.push(clothes[i]);
						}
						else
						{
							shoes.push(clothes[i]);
						}
					}
				}
				if(outfitTemplate.jacket != null)
				{
					if(jackets.length != 0)
					{
						outfit.jacket = jackets.randomElement();
					}
					else
					{
						success = false;
					}
				}
				if(outfitTemplate.sweater)
				{
					if(sweaters.length != 0)
					{
						outfit.sweater = sweaters.randomElement();
					}
					else
					{
						success = false;
					}
				}
				if(outfitTemplate.shirt != null)
				{
					if(shirts.length != 0)
					{
						outfit.shirt = shirts.randomElement();
					}
					else
					{
						success = false;
					}
				}
				if(pants.length != 0)
				{
					outfit.pants = pants.randomElement();
				}
				else
				{
					success = false;
				}
				if(shoes.length !=0)
				{
					outfit.shoes = shoes.randomElement();
				}
				else
				{
					success = false;
				}
			}
			if(iterations >= 100)
			{
				console.log("no outfit");
				return null;
			}
			else
			{
				console.log(outfit);
				return outfit;
			}
		}
		function getMono(wardrobe)
		{
			var success = false;
			var iterations = 0;
			while(!success && iterations < 100)
			{
				iterations++;
				success = true;
				outfitTemplate = getDesiredClothesTypes();
				clothes = trimWardrobe(wardrobe, outfitTemplate, 2);
				var jackets = [];
				var sweaters = [];
				var shirts = [];
				var pants = [];
				var shoes = [];
				var seed = clothes.randomElement();
				var seedi = 0;
				while((seed.colorHsl[1] < .08 || seed.colorHsl[2] < .1 || seed.colorHsl[2] > .96) && seedi < 100)
				{
					seedi++;
					seed = clothes.randomElement();
					if(seedi >= 100)
					{
						console.log("nope");
						return null;
					}
				}
				var outfit = {jacket: null, sweater: null, shirt: null, pants: null, shoes: null}; 
				for(var i = clothes.length-1; i>0; i--)
				{
					if((clothes[i].colorHsl[1] < .08 || clothes[i].colorHsl[2] < .1 || clothes[i].colorHsl[2] > .96) || (clothes[i].colorHsl[0] < seed.colorHsl[0]+2.5 && clothes[i].colorHsl[0] > seed.colorHsl[0]-2.5))
					{
						if(clothes[i].subtype == "Jacket")
						{
							jackets.push(clothes[i]);
						}
						else if(clothes[i].subtype == "Sweater")
						{
							sweaters.push(clothes[i]);
						}
						else if(clothes[i].type == "Top")
						{
							pants.push(clothes[i]);
						}
						else if(clothes[i].type == "Bottom")
						{
							pants.push(clothes[i]);
						}
						else
						{
							shoes.push(clothes[i]);
						}
					}
				}
				if(outfitTemplate.jacket != null)
				{

					if(jackets.length != 0)
					{
						if(seed.subtype == "Jacket")
						{
							outfit.jacket = seed;
						}
						else
						{
							outfit.jacket = jackets.randomElement();
						}
					}
					else
					{
						success = false;
					}
				}
				if(outfitTemplate.sweater)
				{
					if(sweaters.length != 0)
					{
						if(seed.subtype == "Sweater")
						{
							outfit.sweater = seed;
						}
						else
						{
							outfit.sweater = sweaters.randomElement();
						}
					}
					else
					{
						success = false;
					}
				}
				if(outfitTemplate.shirt != null)
				{
					if(shirts.length != 0)
					{	
						if(seed.subtype == "Shirt")
						{
							outfit.shirt = seed;
						}
						else
						{
							outfit.shirt = shirts.randomElement();
						}
					}
					else
					{
						success = false;
					}
				}
				if(pants.length != 0)
				{
					if(seed.subtype == "Pants" || seed.subtype == "Shorts")
					{
						outfit.pants = seed;
					}
					else
					{
						outfit.pants = pants.randomElement();
					}
				}
				else
				{
					success = false;
				}
				if(shoes.length !=0)
				{
					if(seed.type == "Footwear")
					{
						outfit.shoes = seed;
					}
					else
					{
						outfit.shoes = shoes.randomElement();
					}
				}
				else
				{
					success = false;
				}
			}
			if(iterations >= 100)
			{
				return null;
			}
			else
			{
				console.log(outfit);	
				return outfit;
			}
		}
		function getComp(wardrobe)
		{
			var success = false;
			var iterations = 0;
			while(!success && iterations < 100)
			{
				iterations++;
				success = true;
				outfitTemplate = getDesiredClothesTypes();
				clothes = trimWardrobe(wardrobe, outfitTemplate, 2);
				var jackets = [];
				var sweaters = [];
				var shirts = [];
				var pants = [];
				var shoes = [];
				var seed = clothes.randomElement();
				var seed_comp;
				var seedi = 0;
				var hasCompliment = false;
				while((seed.colorHsl[1] < .08 || seed.colorHsl[2] < .1 || seed.colorHsl[2] > .96) || !hasCompliment && seedi < 100 )
				{
					console.log(seed);
					seed = clothes.randomElement();
					console.log("looping");
					for(var i = clothes.length-1; i>=0; i--)
					{
						if(seed.colorHsl[0] > 180)
						{
							if((clothes[i].colorHsl[0] > seed.colorHsl[0]-185) && (clothes[i].colorHsl[0] < seed.colorHsl[0]-175) && seed.subtype != clothes[i].subtype)
							{
								seed_comp = clothes[i];
								hasCompliment = true;
								console.log(seed_comp);

							}
						}
						else
						{
							if((clothes[i].colorHsl[0] > seed.colorHsl[0] + 175) &&(clothes[i].colorHsl[0] < seed.colorHsl[0] + 185))
							{
								seed_comp = clothes[i];
								hasCompliment = true;	
								console.log(seed_comp);
							}
						}
					}
					console.log(seedi);
					console.log(hasCompliment);
					seedi++
					if(seedi >= 99)
					{
						console.log("nope");
						return null;
					}
				}
				var outfit = {jacket: null, sweater: null, shirt: null, pants: null, shoes: null}; 
				for(var i = clothes.length-1; i>0; i--)
				{
					if((clothes[i].colorHsl[1] < .08 || clothes[i].colorHsl[2] < .1 || clothes[i].colorHsl[2] > .96) || (clothes[i].colorHsl[0] < seed.colorHsl[0]+2.5 && clothes[i].colorHsl[0] > seed.colorHsl[0]-2.5) || ((clothes[i].colorHsl[0] < seed_comp.colorHsl[0]+2.5) && (clothes[i].colorHsl[0] > seed_comp.colorHsl[0]-2.5)))
					{
						if(clothes[i].subtype == "Jacket")
						{
							jackets.push(clothes[i]);
						}
						else if(clothes[i].subtype == "Sweater")
						{
							sweaters.push(clothes[i]);
						}
						else if(clothes[i].type == "Top")
						{
							pants.push(clothes[i]);
						}
						else if(clothes[i].type == "Bottom")
						{
							pants.push(clothes[i]);
						}
						else
						{
							shoes.push(clothes[i]);
						}
					}
				}
				if(outfitTemplate.jacket != null)
				{

					if(jackets.length != 0)
					{
						if(seed.subtype == "Jacket")
						{
							outfit.jacket = seed;
						}
						else if(seed_comp.subtype == "Jacket")
						{
							outfit.jacket = seed_comp;
						}
						else
						{
							outfit.jacket = jackets.randomElement();
						}
					}
					else
					{
						success = false;
					}
				}
				if(outfitTemplate.sweater)
				{
					if(sweaters.length != 0)
					{
						if(seed.subtype == "Sweater")
						{
							outfit.sweater = seed;
						}
						else if(seed_comp.subtype == "Sweater")
						{
							outfit.sweater = seed_comp;
						}
						else
						{
							outfit.sweater = sweaters.randomElement();
						}
					}
					else
					{
						success = false;
					}
				}
				if(outfitTemplate.shirt != null)
				{
					if(shirts.length != 0)
					{	
						if(seed.subtype == "Shirt")
						{
							outfit.shirt = seed;
						}
						else if(seed_comp.subtype == "Shirt")
						{
							outfit.shirt = seed_comp;
						}
						else
						{
							outfit.shirt = shirts.randomElement();
						}
					}
					else
					{
						success = false;
					}
				}
				if(pants.length != 0)
				{
					if(seed.subtype == "Pants" || seed.subtype == "Shorts")
					{
						outfit.pants = seed;
					}
					else if(seed_comp.subtype == "Pants" || seed.subtype == "Shorts")
					{
						outfit.pants = seed_comp;
					}
					else
					{
						outfit.pants = pants.randomElement();
					}
				}
				else
				{
					success = false;
				}
				if(shoes.length !=0)
				{
					if(seed.type == "Footwear")
					{
						outfit.shoes = seed;
					}
					else if(seed_comp.type == "Footwear")
					{
						outfit.shoes = seed_comp;
					}
					else
					{
						outfit.shoes = shoes.randomElement();
					}
				}
				else
				{
					success = false;
				}
			}
			if(iterations >= 100)
			{
				return null;
			}
			else
			{
				return outfit;
			}
		}
		Array.prototype.randomElement = function()
		{
			return this[Math.floor(Math.random()*this.length)];
		}


		loadClothes();
	</script>
</html>