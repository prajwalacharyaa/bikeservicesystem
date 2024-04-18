<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Appointments</title>
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
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      margin-top: 0;
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    @media screen and (max-width: 768px) {
      .navbar {
        flex-direction: column;
      }

      .navbar a {
        margin: 5px;
      }

      .container {
        padding: 10px;
      }

      table {
        font-size: 14px;
      }

      th, td {
        padding: 5px;
      }
    }

    /* Style the text color based on appointment status */
    td {
      color: #000;
    }

    /* Set the text color to red for pending appointments */
    td[data-status="pending"] {
      color: red;
    }
    /* Set the text color to red for cancelled appointments */
    td[data-status="cancelled"] {
      color: red;
    }

    /* Set the text color to green for done appointments */
    td[data-status="done"] {
      color: green;
    }

    /* Set the text color to blue for queue appointments */
    td[data-status="queue"] {
      color: blue;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div>
      <a href="customerdashboard.php">Dashboard</a>
    </div>
    <div>
      <form action="customerdashboard.php" method="POST">
        <button type="submit" name="logout">Logout</button>
      </form>
    </div>
  </div>
  
  <div class="container">
    <h2>My Appointments</h2>
    <?php
    session_start();

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION['customer_id'])) {
      header('Location: customerlogin.php');
      exit;
    }

    // Include the database connection file
    require_once '../db.php';

    // Get customer ID from the session
    $customer_id = $_SESSION['customer_id'];

    // Retrieve customer appointments from the database
    $query = "SELECT *, DATEDIFF(NOW(),appointment_date ) AS days_since_appointment FROM appointments WHERE customer_id = '$customer_id'";
    $result = $conn->query($query);

    // Check if there are any appointments
    $appointments = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
      }
    }
    ?>

    <?php if (empty($appointments)) { ?>
      <p>No appointments found.</p>
    <?php } else { ?>
      <div style="background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc; margin-bottom: 20px;">
        <?php
        $recentlyServiced = false;
        foreach ($appointments as $appointment) {
          if ($appointment['days_since_appointment'] <= 60) {
            $recentlyServiced = true;
            break;
          }
        }
        if ($recentlyServiced) {
          echo "Your bike has been recently serviced.";
        } else {
          echo "You need to give your bike for servicing.";
        }
        ?>
      </div>

      <table>
        <tr>
          <th>Appointment ID</th>
          <th>Service Type</th>
          <th>Appointment Date</th>
          <th>Expected Return Time</th>
          <th>Kilometer Covered</th>
          <th>Description</th>
          <th>Status</th>
          <th>Days Since Appointment</th>
        </tr>
        <?php foreach ($appointments as $appointment) { ?>
          <tr>
            <td><?php echo $appointment['id']; ?></td>
            <td><?php echo $appointment['service_type']; ?></td>
            <td><?php echo $appointment['appointment_date']; ?></td>
            <td><?php echo $appointment['appointment_time']; ?></td>
            <td><?php echo $appointment['kilometercovered']; ?></td>
            <td><?php echo $appointment['description']; ?></td>
            <td data-status="<?php echo $appointment['status']; ?>"><?php echo $appointment['status']; ?></td>
            <td>
  <?php
  $daysSinceAppointment = $appointment['days_since_appointment'];

  if ($daysSinceAppointment < 30) {
    echo $daysSinceAppointment . ' days';
  } elseif ($daysSinceAppointment < 365) {
    $months = floor($daysSinceAppointment / 30);
    echo $months . ' ' . ($months === 1 ? 'month' : 'months');
  } else {
    $years = floor($daysSinceAppointment / 365);
    $remainingDays = $daysSinceAppointment % 365;
    echo $years . ' ' . ($years === 1 ? 'year' : 'years');
    if ($remainingDays >= 30) {
      $months = floor($remainingDays / 30);
      echo ' ' . $months . ' ' . ($months === 1 ? 'month' : 'months');
    }
  }
  ?>
</td>

          </tr>
        <?php } ?>
      </table>
    <?php } ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>
  </div>
</body>
</html>
