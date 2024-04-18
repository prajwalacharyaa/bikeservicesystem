<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Customer Information</title>
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
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"] {
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
      <li class="navigation-item"><a href="customer.php">Back</a></li>
      </ul>
    </div>
    <div class="logout">
      <form action="logout.php" method="POST">
        <button type="submit" name="logout">Logout</button>
      </form>
    </div>
  </nav>
  <main class="content">
    <h1>Edit Customer Information</h1>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'bikeservicesystem');
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    if (isset($_GET['id'])) {
      $customerId = $_GET['id'];
      $query = "SELECT id, name, phone, bike, email,dashboardnotice FROM customers WHERE id = '$customerId'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
      } else {
        echo "<p>Customer not found.</p>";
        exit();
      }
    } else {
      echo "<p>Invalid request.</p>";
      exit();
    }

    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $bike = $_POST['bike'];
      $email = $_POST['email'];
      $dashboardnotice=$_POST['dashboardnotice'];

      $query = "SELECT id FROM customers WHERE bike = '$bike' AND id != '$customerId'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        echo "<p>Error: Bike number is already assigned to another customer.</p>";
      } else {
        $query = "UPDATE customers SET name = '$name', phone = '$phone', bike = '$bike', email = '$email',dashboardnotice='$dashboardnotice' WHERE id = '$customerId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
          echo "<p>Customer information updated successfully.</p>";
        } else {
          echo "<p>Error updating customer information: " . mysqli_error($conn) . "</p>";
        }
      }
    }

    if (isset($_POST['delete'])) {
      $query = "DELETE FROM customers WHERE id = '$customerId'";
      $result = mysqli_query($conn, $query);

      if ($result) {
        echo "<p>Customer deleted successfully.</p>";
        // Optionally, you can redirect to another page after successful deletion.
        // header("Location: customers.php");
        // exit();
      } else {
        echo "<p>Error deleting customer: " . mysqli_error($conn) . "</p>";
      }
    }

    mysqli_close($conn);
    ?>

    <form action="" method="POST">
      <label for="name">Name:</label>
      <input type="text" name="name" value="<?php echo $customer['name']; ?>" required>
      <label for="phone">Phone Number:</label>
      <input type="text" name="phone" value="<?php echo $customer['phone']; ?>" required>
      <label for="bike">Bike Number:</label>
      <input type="text" name="bike" value="<?php echo $customer['bike']; ?>" required>
      <label for="email">Email:</label>
      <input type="email" name="email" value="<?php echo $customer['email']; ?>" required>
      <label for="dashboardnotice">Dashboard Notice:</label>
      <input type="dashboardnotice" name="dashboardnotice" value="<?php echo $customer['dashboardnotice']; ?>" >
      <button type="submit" name="submit">Update</button>
    </form>

    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
      <button type="submit" name="delete">Delete Customer</button>
    </form>
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