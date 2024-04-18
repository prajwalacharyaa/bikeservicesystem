<?php

require_once '../db.php'; // Include the database connection file

// Function to get the total number of customers
function getTotalCustomers() {
  global $conn; // Access the database connection
  
  $query = "SELECT COUNT(*) AS total FROM customers";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row['total'];
  }
  
  return 0;
}

// Function to get the total number of bikes
function getTotalBikes() {
  global $conn; // Access the database connection
  
  $query = "SELECT COUNT(*) AS total FROM bikes";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row['total'];
  }
  
  return 0;
}

// Function to get the total number of appointments
function getTotalAppointments() {
  global $conn; // Access the database connection
  
  $query = "SELECT COUNT(*) AS total FROM appointments";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row['total'];
  }
  
  return 0;
}

?>
