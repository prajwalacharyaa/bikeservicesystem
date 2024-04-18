<?php
// Start the session before any output
session_start();

// Connect to the database
$servername = "localhost"; // Change this if your database is on a different server
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "bikeservicesystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the input from the login form
$bike = $_POST['bike'];
$password = $_POST['password'];

// Verify the user using prepared statements
$stmt = $conn->prepare("SELECT * FROM customers WHERE bike = ?");
$stmt->bind_param("s", $bike);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Check if the provided password matches the stored password
    if ($password === $storedPassword) {
        // Login successful
        $_SESSION['customer_id'] = $row['id'];
        $_SESSION['customer_name'] = $row['name'];
        $_SESSION['bike_no'] = $bike;


        header("Location: customerdashboard.php");
        exit();
        // You can redirect the user to a dashboard page or perform any other actions here
    } else {
        // Incorrect password
        echo "Incorrect password. Please try again.";
    }
} else {
    // bike number not found
    echo "bike number not found. Please register or try again.";
}

$stmt->close();
$conn->close();
?>
