<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Signup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .signup-container {
      width: 300px;
      margin: 100px auto;
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .signup-container h2 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group button {
      width: 100%;
      padding: 8px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h2>Customer Signup</h2>
    <form action="customer_signup_handler.php" method="POST">
      <div class="form-group">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[9]{1}[8]{1}[0-9]{8}" required>
        <small>Phone number must start with "98" and be 10 digits long.</small>
      </div>

      <div class="form-group">
        <label for="phone">Bike Number:</label>
        <input type="text" id="bike" name="bike" required>
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="form-group">
        <button type="submit">Signup</button>
      </div>
      <p>Already Signed Up? <a href="customerlogin.php">LogIn Here</a></p>
    </form>
  </div>
</body>
</html>
