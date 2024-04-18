<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Head content and CSS links as before -->
</head>
<body>
  <div class="container">
    <!-- Sidebar and Main content as before -->
    <main class="content">
      <h1>Appointment Confirmed</h1>

      <?php
      // Check if the confirmation page is accessed directly without booking an appointment
      if (!isset($_GET['booking_id'])) {
        echo "<p>Error: No appointment booking data found.</p>";
        echo "<p>Please make sure you have booked an appointment.</p>";
      } else {
        $booking_id = $_GET['booking_id'];

        // Retrieve the appointment details from the database using the booking_id
        require_once 'db.php'; // Include the database connection file

        $query = "SELECT * FROM appointments WHERE id = $booking_id";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $appointment = $result->fetch_assoc();
          $customer_id = $appointment['customer_id'];

          // Retrieve the customer details from the database using the customer_id
          $customerQuery = "SELECT * FROM customers WHERE id = $customer_id";
          $customerResult = $conn->query($customerQuery);

          if ($customerResult->num_rows > 0) {
            $customer = $customerResult->fetch_assoc();
            $customer_name = $customer['name'];
            $service_type = $appointment['service_type'];
            $appointment_date = $appointment['appointment_date'];

            // Display the appointment confirmation details
            echo "<p>Dear $customer_name, your $service_type appointment has been confirmed for $appointment_date.</p>";
            echo "<p>Thank you for choosing our services!</p>";
          } else {
            echo "<p>Error: Customer details not found.</p>";
          }
        } else {
          echo "<p>Error: Appointment details not found.</p>";
        }
      }
      ?>

      <p><a href="appointments.php">Back to Book Appointment</a></p>
    </main>
  </div>
</body>
</html>
