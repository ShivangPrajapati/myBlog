<?php

//$conn = new mysqli("localhost","root","","blog");

//if($conn->connect_error) {
//	die("Connection failed".$conn->connect_error);
//}

//else {

//}

$servername = "localhost";
$username = "root";
$password = "";
$db = "blog";

// Create connection
 $conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>