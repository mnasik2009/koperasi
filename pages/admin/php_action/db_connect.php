<?php 

$servername = "localhost";
$username = "nasikin";
$password = "17102007";
$dbname = "bahanbaku";

// create connection
$connect = new mysqli($servername, $username, $password, $dbname);

// check connection 
if($connect->connect_error) {
	die("Connection Failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
}