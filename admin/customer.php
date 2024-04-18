<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Management</title>
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

    /* Custom styles for the customer table */
    table {
      margin-top: 20px;
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
  </style>
</head>
<body>
<div class="container">
<?php include 'navigation.php'; ?>

  <main class="content">
    <h1>Customer Management</h1>
    <?php
    // Replace this with your actual database connection
    $conn = mysqli_connect('localhost', 'root', '', 'bikeservicesystem');

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    // Perform the database query to retrieve customer information
    $query = "SELECT id, name, phone, bike, email,dashboardnotice FROM customers";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>
      <table>
        <tr>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Bike Number</th>
          <th>Email</th>
          <th>Dashboard Notice</th>
          <th>Edit</th>
        </tr>
        <?php
        // Loop through the results and display each row in the table
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['bike']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['dashboardnotice']; ?></td>
            <td><a href="customeredit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
          </tr>
        <?php
        }
        ?>
      </table>
    <?php
    } else {
      echo "<p>No customers found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </main>
</div>
<script>
  const hamburgerIcon = document.querySelector('.hamburger-icon');
  const mobileMenu = document.querySelector('.mobile-menu');

  hamburgerIcon.addEventListener('click', () => {
    mobileMenu.classList.toggle('show-mobile-menu');
  });
</script>
</body>
</html>
