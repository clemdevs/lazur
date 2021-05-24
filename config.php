<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lazur";

// Create connection
$dbConn = new mysqli($servername, $username, $password, $dbname);

// Check if successful connection
if (!$dbConn) {
  die("Connection failed: " . $conn->connect_error . "\n"
                            . $conn->connect_errno . "\n");
} else {
   return; //successful connection
}


?>

