<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Head content and CSS links as before -->
</head>
<body>
  <div class="container">
    <!-- Sidebar and Main content as before -->
    <main class="content">
      <h1>Book Appointment</h1>

      <?php
      require_once 'db.php'; // Include the database connection file

      
      // Check if form is submitted
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $customer_id = $_POST['customer_id'];
        $service_type = $_POST['service_type'];
        $appointment_date = $_POST['appointment_date'];

        // Insert appointment data into the database
        $query = "INSERT INTO appointments (customer_id, service_type, appointment_date) 
                  VALUES ('$customer_id','$service_type', '$appointment_date')";

        if ($conn->query($query) === TRUE) {
          // Redirect to the confirmation page after successful booking
          header('Location: appointment_confirmation.php');
          exit(); // Make sure to exit the script after redirection
        } else {
          echo "Error booking appointment: " . $query . "<br>" . $conn->error;
        }
      }
      ?>

      <div class="card">
        <!-- Form as before -->
      </div>
    </main>
  </div>
</body>
</html>
