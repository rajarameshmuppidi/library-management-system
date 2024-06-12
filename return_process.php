<?php

// Get the ID from the URL parameter
$id = $_GET['id'];

// Get the current timestamp
$current_date = date('Y-m-d H:i:s');;

// Get the fine amount from the GET parameter
$fine = $_GET['fine'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the row in the table
$sql = "UPDATE issuedbookdetails SET ReturnStatus = 1, ReturnDate = '$current_date', Fine = '$fine' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    header("location:manage_issued_book.php?msg=returned");
    die();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the database connection
$conn->close();

?>
