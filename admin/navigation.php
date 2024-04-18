<head>
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

  </style>
  </head>
<body>
<nav class="sidebar">
      <div class="logo">
        <img src="../image/logo.png" alt="Logo">
      </div>
      <div class="navigation">
        <ul>
          <li class="navigation-item"><a href="admindashboard.php">Dashboard</a></li>
          <li class="navigation-item"><a href="customer.php">Customers</a></li>
          <li class="navigation-item"><a href="appoinments.php">Appointments</a></li>

          
          <br><br><br>
          <li class="navigation-item"><a href="../index.php">Go to HomePage</a></li>

          <!-- Add more menu items here -->
        </ul>
      </div>
      <div class="logout">
        <form action="logout.php" method="POST">
          <button type="submit" name="logout">Logout</button>
        </form>
      </div>
    </nav>
</body>