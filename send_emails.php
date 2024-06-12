<?php
session_start();
include("root.php");

if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get last_sent date from sent_emails table
$sql = "SELECT last_sent FROM sent_emails ORDER BY last_sent DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // Last_sent exists, check if it is today's date
  $row = $result->fetch_assoc();
  if ($row["last_sent"] == date("Y-m-d")) {
    echo "<center><h2 style='color:red;align-text:center;'>Emails already sent today.</h2></center>";
  } else {
    // Last_sent is not today's date, call emailing.php to send emails
    include 'emails.php';
    // Update last_sent to current date
    $sql = "UPDATE sent_emails SET last_sent = CURRENT_DATE";
    if ($conn->query($sql) === TRUE) {
      echo "Emails sent successfully.";
    } else {
      echo "Error updating last_sent: " . $conn->error;
    }
  }
} else {
  // No last_sent exists, call emailing.php to send emails
  include 'emails.php';
  // Insert current date as last_sent
  $sql = "INSERT INTO sent_emails (last_sent) VALUES (CURRENT_DATE)";
  if ($conn->query($sql) === TRUE) {
    echo "Emails sent successfully.";
  } else {
    echo "Error updating last_sent: " . $conn->error;
  }
}

$conn->close();
?>
