<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #333;
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

    .navbar-logo {
      height: 40px;
      margin-right: 20px;
    }

    .container {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
      color: #fff;
    }

    .container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("https://images.unsplash.com/photo-1508357941501-0924cf312bbd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      opacity: 0.3;
      z-index: -1;
    }

    .heading {
      font-size: 40px;
      margin-bottom: 20px;
    }

    .heading span {
      color: red; /* Make the "Hero Bike" text red */
    }

    .description {
      font-size: 20px;
      text-align: center;
      max-width: 600px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <img class="navbar-logo" src="image/logo.png" alt="Logo">
    <div>
      <a href="#">Home</a>
      <a href="services.php">Services</a>
      <a href="admin/adminlogin.php">Admin Login</a>
      <a href="customer/customerdashboard.php">Customer Dashboard</a>
    </div>
  </div>

  <div class="container">
    <h1 class="heading">Welcome to <span>Hero Bike</span> Service Center</h1>
    <p class="description">
      Here we provide every kind of bike repair and servicing that you might ever require throughout your adventurous journey with your bikes.
    </p>
  </div>
</body>
</html>
