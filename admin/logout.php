<?php
session_start();

// If the logout button is clicked
if (isset($_POST['logout'])) {
  // Clear all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect the user to the login page or homepage
  header('Location: ../index.php'); // Replace "login.php" with the actual login page URL
  exit;
}
