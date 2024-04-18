<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['customer_id'])) {
  header('Location: customerlogin.php');
  exit;
}

// Include the database connection file
require_once '../db.php';
  // Get customer name from the session
  $customer_name = $_SESSION['customer_name'];
  $bike_no = $_SESSION['bike_no'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $customer_id = $_SESSION['customer_id'];
  $service_type = $_POST['service_type'];
  $appointment_date = $_POST['appointment_date'];
  $appointment_time = $_POST['appointment_time'];
  $kilometercovered = $_POST['kilometercovered'];
  $description = $_POST['description'];

  // Combine date and time to form a datetime format
  $appointment_datetime = $appointment_date . ' ' . $appointment_time;
// Validate the appointment date and time
$current_datetime = date('Y-m-d H:i:s');
$appointment_datetime = $appointment_date . ' ' . $appointment_time;
if (strtotime($appointment_datetime) < strtotime($current_datetime)) {
  // Invalid appointment date and time, redirect back to the form with an error message
  $_SESSION['appointment_error'] = true;
  header('Location: customerdashboard.php');
  exit;
}
  // Insert appointment data into the database
  $query = "INSERT INTO appointments (customer_id,customer_name,bike_no, service_type, appointment_date, kilometercovered,description) 
            VALUES ('$customer_id','$customer_name', '$bike_no','$service_type', '$appointment_datetime','$kilometercovered','$description')";

 // After successfully booking the appointment
if ($conn->query($query) === TRUE) {
    // Set a session variable to indicate successful booking
    $_SESSION['appointment_booked'] = true;
    
    // Redirect to customer dashboard
    header('Location: customerdashboard.php');
    exit;
  } else {
    echo "Error booking appointment: " . $query . "<br>" . $conn->error;
  }
  
}
?>