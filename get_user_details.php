<?php
// Connect to the database
$mysqli = new mysqli('localhost', 'root', '', 'demo');

// Retrieve the user ID from the AJAX request
$user_id = $_POST['user_id'];

// Retrieve the details of the user from the database
$stmt = $mysqli->prepare("SELECT * FROM users WHERE sid = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Return the details of the user as a JSON object
echo json_encode($user);
?>
