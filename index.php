<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Your Dashboard</title>
</head>
<body>
	<link rel="stylesheet" href = "mainPage.css">
	<ul>
		<li class="current"><a href ="profile.php">DASHBOARD</a></li>
		<li><a href ="weather.php">WEATHER</a></li>
		<li><a href ="wardrobe.php">WARDROBE</a></li>
		<li><a href ="outfits.php">OUTFITS</a></li>
		<li><a href ="profile.php">PROFILE</a></li>
	</ul>
	<div class="wrapper">
		<div class="uppertile">
			<div class="innercontent">
				<h1>Weather</h1>
				<img src = "https://requestreduce.org/images/sun-clipart-public-domain-10.png">
				<p id="temperature"> 74</p>
			</div>
		</div>
		<div class="uppertile">
			<div class="innercontent">
				<h1> Wardrobe </h1>
			</div>
		</div>
		<div class="tile">
			<div class="innercontent">
				<h1> Outfits </h1>
			</div>
		</div>
		<div class="tile">
			<div class="innercontent">
				<h1> Profile </h1>
			</div>
		</div>
	</div>
</body>
</html>