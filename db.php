<?php
$host = 'localhost'; 
$db = 'bikeservicesystem'; 
$user = 'root'; 
$password = ''; 

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}
