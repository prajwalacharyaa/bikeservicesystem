<?php
// customersignup.php

// Include the database connection file
require_once '../db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $bike = $_POST['bike'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate phone number
  if (!preg_match('/^9[0-9]{9}$/', $phone)) {
    echo "Invalid phone number format. Phone number must start with '98' and be 10 digits long.";
    exit;
  }

  // Insert customer data into the database with plain text password
  $query = "INSERT INTO customers (name, phone,bike, email, password) VALUES ('$name', '$phone','$bike', '$email', '$password')";

  if ($conn->query($query) === TRUE) {
    echo "Signup successful! You will move to login screen in 3 seconds";
    header("refresh:2;url=customerlogin.php");
  } else {
    echo "Error inserting customer data: " . $query . "<br>" . $conn->error;
  }
}
?>
