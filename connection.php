<?php
$servername = "localhost";
$username = "root";
$password = "";


     $conn = new mysqli('localhost','root','','youtubeclone');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	}

?>
