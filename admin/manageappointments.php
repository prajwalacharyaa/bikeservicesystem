<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Appointments</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="customer.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      display: flex;
      align-items: flex-start;
      min-height: 100vh;
    }

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
    }

    .logo {
      margin-top: 30px;
      text-align: center;
    }

    .logo img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
    }

    .navigation {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 30px;
      flex-shrink: 0;
      flex-grow: 1;
      overflow-y: auto;
    }

    .navigation-item {
      list-style: none;
      margin: 10px 0;
    }

    .navigation-item a {
      text-decoration: none;
      color: #333;
      font-size: 18px;
      padding: 5px 20px;
      border-bottom: 2px solid transparent;
    }

    .navigation-item a:hover {
      border-bottom-color: #ff0000;
    }

    .logout {
      margin-top: auto;
      text-align: center;
    }

    .logout form {
      display: inline-block;
    }

    .logout button {
      background-color: #ff0000;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .content {
      flex: 3;
      padding: 20px;
      margin-left: 250px;
    }

    h1 {
      margin-bottom: 20px;
      color: #ff0000;
      margin-left: 250px;
    }

    /* Additional styles for the manage appointments form */
    form {
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    button {
      background-color: #ff0000;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    /* Center the form on larger screens */
    @media (min-width: 768px) {
      form {
        margin-top: 50px;
      }
    }

    /* Make the form responsive for smaller screens */
    @media (max-width: 767px) {
      form {
        margin-top: 20px;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <nav class="sidebar">
    <div class="logo">
      <img src="../image/logo.png" alt="Logo">
    </div>
    <div class="navigation">
      <ul>
        <li class="navigation-item"><a href="appoinments.php">Back</a></li>
        <li class="navigation-item"><a href="../index.php">HomePage</a></li>
        <!-- Add more menu items here -->
      </ul>
    </div>
    <div class="logout">
      <form action="logout.php" method="POST">
        <button type="submit" name="logout">Logout</button>
      </form>
    </div>
  </nav>
  <main class="content">
    <h1>Edit Appointment Information</h1>
    <?php
    // Replace this with your actual database connection
    $conn = mysqli_connect('localhost', 'root', '', 'bikeservicesystem');

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    if (isset($_GET['id'])) {
      $appointmentId = $_GET['id'];

      // Fetch appointment data by ID from the database
      $query = "SELECT id, customer_name, bike_no, appointment_date, service_type, appointment_time, description, kilometercovered, status FROM appointments WHERE id = '$appointmentId'";
      $result = mysqli_query($conn, $query);

      // Check if the query executed successfully
      if ($result) {
        // Check if there are any rows in the result set
        if (mysqli_num_rows($result) > 0) {
          $appointment = mysqli_fetch_assoc($result);
        } else {
          echo "<p>Appointment not found.</p>";
          exit();
        }
      } else {
        echo "<p>Error executing the database query: " . mysqli_error($conn) . "</p>";
        exit();
      }
    } else {
      echo "<p>Invalid request.</p>";
      exit();
    }

    // Handle form submission
    if (isset($_POST['submit'])) {
      // Retrieve form data
      $customerName = $_POST['customer_name'];
      $bikeNo = $_POST['bike_no'];
      $appointmentDate = $_POST['appointment_date'];
      $serviceType = $_POST['service_type'];
      $appointmentTime = $_POST['appointment_time'];
      $description = $_POST['description'];
      $kilometerCovered = $_POST['kilometercovered'];
      $status = $_POST['status'];

      // Update appointment information in the database
      $query = "UPDATE appointments SET customer_name = '$customerName', bike_no = '$bikeNo', appointment_date = '$appointmentDate', service_type = '$serviceType', appointment_time = '$appointmentTime', description = '$description', kilometercovered = '$kilometerCovered', status = '$status' WHERE id = '$appointmentId'";
      $result = mysqli_query($conn, $query);

      if ($result) {
        echo "<p>Appointment information updated successfully.</p>";
      } else {
        echo "<p>Error updating appointment information: " . mysqli_error($conn) . "</p>";
      }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <form action="" method="POST">
      <label for="customer_name">Customer Name:</label>
      <input type="text" name="customer_name" value="<?php echo isset($_GET['customer_name']) ? htmlspecialchars($_GET['customer_name']) : $appointment['customer_name']; ?>" required>
      <label for="bike_no">Bike Number:</label>
      <input type="text" name="bike_no" value="<?php echo isset($_GET['bike_no']) ? htmlspecialchars($_GET['bike_no']) : $appointment['bike_no']; ?>" required>
      <label for="appointment_date">Appointment Date:</label>
      <input type="datetime-local" name="appointment_date" value="<?php echo isset($_GET['appointment_date']) ? htmlspecialchars($_GET['appointment_date']) : $appointment['appointment_date']; ?>" required>
      <label for="service_type">Service Type:</label>
      <input type="text" name="service_type" value="<?php echo isset($_GET['service_type']) ? htmlspecialchars($_GET['service_type']) : $appointment['service_type']; ?>" required>
      <label for="appointment_time">Appointment Time:</label>
      <input type="datetime-local" name="appointment_time" value="<?php echo isset($_GET['appointment_time']) ? htmlspecialchars($_GET['appointment_time']) : $appointment['appointment_time']; ?>" required>
      <label for="description">Description:</label>
      <textarea name="description" rows="4" required><?php echo isset($_GET['description']) ? htmlspecialchars($_GET['description']) : $appointment['description']; ?></textarea>
      <label for="kilometercovered">Kilometer Covered:</label>
      <input type="text" name="kilometercovered" value="<?php echo isset($_GET['kilometercovered']) ? htmlspecialchars($_GET['kilometercovered']) : $appointment['kilometercovered']; ?>" required>
      <label for="status">Status:</label>
      <select name="status" required>
        <option value="pending" <?php if ($appointment['status'] === 'pending') echo 'selected'; ?>>Pending</option>
        <option value="queue" <?php if ($appointment['status'] === 'queue') echo 'selected'; ?>>Queue</option>
        <option value="done" <?php if ($appointment['status'] === 'done') echo 'selected'; ?>>Done</option>
        <option value="cancelled" <?php if ($appointment['status'] === 'cancelled') echo 'selected'; ?>>Cancelled</option>
      </select>      
      <button type="submit" name="submit">Update</button>
    </form>
  </main>
</div>
</body>
</html>
