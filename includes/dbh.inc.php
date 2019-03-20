<?php

// $serverName = "mysql.1819.lakeside-cs.org";
// $dBUsername = "student1819";
// $dBPassword = "m760CS4Fall18";
// $dBName = "1819project";

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "root";
$dBName = "1819playground";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName); 

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}