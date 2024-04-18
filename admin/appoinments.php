<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointments</title>
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
      margin-left: 300px;
    }

    .order{
      margin-left:50px;
    }
    /* Additional styles for the appointments table */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #ff0000;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    /* Center the table on larger screens */
    @media (min-width: 768px) {
      table {
        margin: 20px auto;
        max-width: 800px;
      }
    }

    /* Make the table responsive for smaller screens */
    @media (max-width: 767px) {
      table {
        width: 100%;
      }
      th, td {
        width: 25%;
      }
    }

    /* Additional styles for the clickable rows */
    table {
      cursor: pointer;
    }

    tr {
      transition: background-color 0.3s;
    }

    tr:hover {
      background-color: #f2f2f2;
    }

    /* Additional styles for the sorting form */
    #sortForm {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 20px;
    }

    #sortForm label {
      margin-right: 10px;
    }
    * Style the text color based on appointment status */
    td {
      color: #000; /* Set the default text color to black */
    }
    td[data-date] {
      color: red;
    }
    td[data-time] {
      color: green;
    }
    /* Set the text color to red for pending appointments */
    td[data-status="pending"] {
      color: red;
    }
    /* Set the text color to red for pending appointments */
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
  <script>
    // JavaScript function to submit the sorting form when the select option changes
    function sortAppointments() {
      const sortForm = document.getElementById('sortForm');
      sortForm.submit();
    }
  </script>
</head>
<body>
<div class="container">
  <nav class="sidebar">
    <div class="logo">
      <img src="../image/logo.png" alt="Logo">
    </div>
    <div class="navigation">
      <ul>
        <li class="navigation-item"><a href="admindashboard.php">Dashboard</a></li>
        <li class="navigation-item"><a href="customer.php">Customers</a></li>
        <li class="navigation-item"><a href="appoinments.php">Appointments</a></li>
        <li class="navigation-item"><a href="appointmenthistory.php">History</a></li>

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
    <h1>Appointments</h1>
    <div class="order">
    <form action="" method="POST" id="sortForm">
      <label for="sort_order">Sort by Appointment Date:</label>
      <br>
      <select name="sort_order" id="sort_order" onchange="sortAppointments()">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
      </select>
    </form>
  </div>
    <?php
    // Replace this with your actual database connection
    $conn = mysqli_connect('localhost', 'root', '', 'bikeservicesystem');

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    // Handle sorting option
    $sortOrder = "asc"; // Default sort order
    if (isset($_POST['sort_order'])) {
      $sortOrder = $_POST['sort_order'];
    }

    // Perform the database query to retrieve appointment information with sorting
    $query = "SELECT id, customer_name, bike_no, appointment_date, service_type, appointment_time, description, kilometercovered, status FROM appointments ORDER BY appointment_date $sortOrder";
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($result) {
      // Check if there are any rows in the result set
      if (mysqli_num_rows($result) > 0) {
    ?>
  <table>
        <tr>
          <th>ID</th>
          <th>Customer Name</th>
          <th>Bike Number</th>
          <th>Appointment Date</th>
          <th>Service Type</th>
          <th>Appointment Time</th>
          <th>Description</th>
          <th>Kilometer Covered</th>
          <th>Status</th>
        </tr>
        <?php
        // Loop through the results and display each row in the table
        while ($row = mysqli_fetch_assoc($result)) {
          // Hide rows with status "done"
          if ($row['status'] === 'done') {
            continue;
          }
          if ($row['status'] === 'cancelled') {
            continue;
          }
        ?>
          <tr onclick="window.location.href='manageappointments.php?id=<?php echo $row['id']; ?>&customer_name=<?php echo urlencode($row['customer_name']); ?>&bike_no=<?php echo urlencode($row['bike_no']); ?>&appointment_date=<?php echo urlencode($row['appointment_date']); ?>&service_type=<?php echo urlencode($row['service_type']); ?>&appointment_time=<?php echo urlencode($row['appointment_time']); ?>&description=<?php echo urlencode($row['description']); ?>&kilometercovered=<?php echo urlencode($row['kilometercovered']); ?>&status=<?php echo urlencode($row['status']); ?>'">
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['bike_no']; ?></td>
            <td data-date="<?php echo $row['appointment_date']; ?>"><?php echo $row['appointment_date']; ?></td>

            <td><?php echo $row['service_type']; ?></td>
            <td data-time="<?php echo $row['appointment_time']; ?>"><?php echo $row['appointment_time']; ?></td>

            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['kilometercovered']; ?></td>
            <td data-status="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></td>
          </tr>
        <?php
        }
        ?>
      </table>
    <?php
      } else {
        echo "<p>No appointments found.</p>";
      }
    } else {
      echo "<p>Error executing the database query: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </main>
</div>
</body>
</html>
