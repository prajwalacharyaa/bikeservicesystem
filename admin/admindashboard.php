<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
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
      flex: 1;
      padding: 20px;
    }

    .card-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .card {
      width: 30%;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      text-align: center;
      cursor:pointer;
    }

    .card i {
      font-size: 48px;
      color: #ff0000;
    }

    .card h2 {
      margin-top: 10px;
      color: #ff0000;
    }

    .card p {
      margin-top: 5px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
      }

      .navigation {
        margin-top: 0;
        margin-bottom: 20px;
      }

      .card {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
  <?php include 'navigation.php'; ?>
    <main class="content">
      <h1>Welcome to the Admin Dashboard</h1>

      <?php require_once 'functions.php'; ?>

      <div class="card-container">
        <div class="card">
          <i class="uil uil-user"></i>
          <h2>Customers</h2>
          <p>Total Customers: <?php echo getTotalCustomers(); ?></p>
        </div>

        <div class="card">
          <i class="uil uil-setting"></i>
          <h2>Bikes</h2>
          <p>Total Bikes: <?php echo getTotalBikes(); ?></p>
        </div>

        <div class="card">
          <i class="uil uil-schedule"></i>
          <h2>Appointments</h2>
          <p>Total Appointments: <?php echo getTotalAppointments(); ?></p>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
