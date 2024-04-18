<?php
session_start();

// Check if the admin is already logged in, redirect to the dashboard
if (isset($_SESSION['admin_id'])) {
  header('Location: admindashboard.php');
  exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Include the database connection file
  require_once '../db.php';

  // Get the form data
  $login_phone = $_POST['login_phone'];
  $password = $_POST['password'];

  // Prepare and execute the SQL query to check admin credentials
  $query = "SELECT id, password FROM admin WHERE login_phone = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $login_phone);
  $stmt->execute();
  $stmt->store_result();

  // Check if an admin with the provided login phone exists
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($admin_id, $hashed_password);
    $stmt->fetch();

    // Verify the provided password against the hashed password
    if (password_verify($password, $hashed_password)) {
      // Password is correct, set the admin_id in the session and redirect to the dashboard
      $_SESSION['admin_id'] = $admin_id;
      header('Location: admindashboard.php');
      exit;
    } else {
      // Incorrect password, display an error message
      $error_message = 'Invalid login phone or password';
    }
  } else {
    // Admin with the provided login phone not found, display an error message
    $error_message = 'Invalid login phone or password';
  }

  // Close the statement and database connection
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-form {
      width: 300px;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      appearance: none;
    }

    .form-group button {
      width: 100%;
      padding: 8px;
      background-color: #007bff; /* Blue background color for the button */
      color: #fff; /* White text color for the button */
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #0056b3; /* Darker blue color on hover */
    }

    /* Style for the error message */
    .error-message {
      color: #ff0000;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-form">
      <form action="adminlogin.php" method="POST">
        <?php if (isset($error_message)) { ?>
          <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <div class="form-group">
          <label for="login_phone">Admin ID:</label>
          <input type="text" id="login_phone" name="login_phone" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
          <button type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
