<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
  header('Location: customerlogin.php');
  exit;
}

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header('Location: ../index.php');
  exit;
}

require_once '../db.php';

$customer_id = $_SESSION['customer_id'];

$query = "SELECT dashboardnotice FROM customers WHERE id = '$customer_id'";
$result = $conn->query($query);
$dashboardnotice = '';

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $dashboardnotice = $row['dashboardnotice'];
}

$appointment_booked = false;
$appointment_error = false;
if (isset($_SESSION['appointment_booked']) && $_SESSION['appointment_booked'] === true) {
  $appointment_booked = true;
  unset($_SESSION['appointment_booked']);
}
if (isset($_SESSION['appointment_error']) && $_SESSION['appointment_error'] === true) {
  $appointment_error = true;
  unset($_SESSION['appointment_error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .navbar {
      background-color: #444;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
    }

    .navbar a {
      color: #fff;
      text-decoration: none;
      margin: 0 10px;
    }

    .navbar a:hover {
      color: #ddd;
    }

    .container {
      display: flex;
      flex-direction: column; /* Stacking items vertically */
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .appointment-notice-container {
      padding-bottom: 20px; /* Add some spacing between the notice and the form */
    }

    .appointment-form {
      width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Center the form on the page */
      margin: 0 auto;
    }

    .dashboard-notice{
      margin-bottom:20px;
      color:red;
      font-size:22px;
    }

    /* Style for the success message */
    .success-message {
      color: #4CAF50;
      font-weight: bold;
      text-align: center;
      margin-top: 20px; /* Add some spacing between the form and the success message */
    }

    .error-message {
      color: #4CAF50;
      font-weight: bold;
      text-align: center;
      margin-top: 20px; /* Add some spacing between the form and the success message */
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group textarea,
    .form-group input[type="date"],
    .form-group input[type="time"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      appearance: none;
    }

    .form-group button {
      width: 100%;
      padding: 8px;
      background-color: #ff0000; /* Red background color for the button */
      color: #fff; /* White text color for the button */
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #cc0000; /* Darker red color on hover */
    }

    /* Style for the success message */
    .success-message {
      color: #4CAF50;
      font-weight: bold;
      text-align: center;
      margin-top: -60px;
    }
    .error-message {
      color: #4CAF50;
      font-weight: bold;
      text-align: center;
      margin-top: -60px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div>
      <a href="../index.php">Home</a>
    </div>
    <div>
      <a href="customerappoinments.php">My Appointments</a>
    </div>
    <div>
      <!-- Logout form -->
      <form action="customerdashboard.php" method="POST">
        <button type="submit" name="logout">Logout</button>
      </form>
    </div>
  </div>

  <div class="container">
    <?php if (!empty($dashboardnotice)) { ?>
      <div class="dashboard-notice"><?php echo $dashboardnotice; ?></div>
    <?php } ?>
    <div class="appointment-form">
      <form action="book_appointment_handler.php" method="POST">
        <div class="form-group">
          <label for="service_type">Service Type:</label>
          <select id="service_type" name="service_type" required>
            <option value="Regular Service">Regular Service</option>
            <option value="Repair">Repair</option>
            <option value="Maintenance">Maintenance</option>
          </select>
        </div>

        <div class="form-group">
          <label for="appointment_date">Appointment Date:</label>
          <input type="date" id="appointment_date" name="appointment_date" required>
        </div>

        <div class="form-group">
          <label for="appointment_time">Appointment Time:</label>
          <input type="time" id="appointment_time" name="appointment_time" required>
        </div>
        <div class="form-group">
          <label for="Kilometer Covered">Kilometer Covered:</label>
          <textarea id="kilometercovered" name="kilometercovered" rows="1" required></textarea>
        </div>

        <div class="form-group">
          <label for="description">Description:</label>
          <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
          <button type="submit">Book Appointment</button>
        </div>
      </form>
    </div>
  </div>

  <?php if ($appointment_booked) { ?>
    <!-- Display the success message if the appointment was booked successfully -->
    <div class="success-message">Appointment booked successfully!</div>
  <?php } ?>
  <?php if ($appointment_error) { ?>
    <!-- time error -->
    <div class="error-message">Please check the date!!!</div>
  <?php } ?>

</body>
</html>
