<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="customer.css">
</head>
<body>
  <div class="container">
    <nav class="sidebar">
      <ul>
        <li><a href="dashboard.html">Dashboard</a></li>
        <li><a href="customer.php">Customers</a></li>
        <li><a href="#">Bikes</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Appointments</a></li>
        <li><a href="#">Rentals</a></li>
      </ul>
    </nav>
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
                  VALUES ('$customer_id', '$service_type', '$appointment_date')";

        if ($conn->query($query) === TRUE) {
          echo "Appointment booked successfully!";
        } else {
          echo "Error booking appointment: " . $query . "<br>" . $conn->error;
        }
      }
      ?>

      <div class="card">
        <h2>Book an Appointment</h2>
        <form action="appointments.php" method="POST">
          <label for="customer_id">Select Customer:</label>
          <select id="customer_id" name="customer_id" required>
            <?php
            $customersQuery = "SELECT * FROM customers";
            $customersResult = $conn->query($customersQuery);
            while ($customer = $customersResult->fetch_assoc()) {
              echo '<option value="' . $customer['id'] . '">' . $customer['name'] . '</option>';
            }
            ?>
          </select>

          <label for="service_type">Select Service Type:</label>
          <select id="service_type" name="service_type" required>
            <option value="Repair">Repair</option>
            <option value="Maintenance">Maintenance</option>
            <option value="Tune-up">Tune-up</option>
            <!-- Add more options if needed -->
          </select>

          <label for="appointment_date">Appointment Date:</label>
          <input type="date" id="appointment_date" name="appointment_date" required>

          <input type="submit" value="Book Appointment">
        </form>
      </div>
    </main>
  </div>
</body>
</html>
