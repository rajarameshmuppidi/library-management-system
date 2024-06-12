<?php
// Get the user ID and status value from the AJAX request
$userId = $_POST["userId"];
$status = $_POST["status"];

// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$database = "demo";

$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Update the status value in the database
$sql = "UPDATE users SET status='$status' WHERE sid='$userId'";

if (mysqli_query($conn, $sql)) {
  echo "Status updated successfully";
} else {
  echo "Error updating status: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
