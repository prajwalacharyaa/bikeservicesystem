<?php
require_once 'db.php'; // Include the database connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $bikeNumber = $_POST['bike_number'];

  // Insert customer data into the database
  $query = "INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

  if ($conn->query($query) === TRUE) {
    $customerId = $conn->insert_id;
    
    // Insert bike data into the database
    $query = "INSERT INTO bikes (customer_id, bike_number) VALUES ('$customerId', '$bikeNumber')";
    
    if ($conn->query($query) === TRUE) {
      echo "Customer and Bike added successfully!";
    } else {
      echo "Error inserting Bike: " . $query . "<br>" . $conn->error;
    }
  } else {
    echo "Error inserting Customer: " . $query . "<br>" . $conn->error;
  }
}
?>
