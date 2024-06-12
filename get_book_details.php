<?php
// Connect to the database
$mysqli = new mysqli('localhost', 'root', '', 'demo');

// Retrieve the book ID from the AJAX request
$book_id = $_POST['book_id'];

// Retrieve the details of the book from the database
$stmt = $mysqli->prepare("SELECT * FROM books WHERE Bid = ?");
$stmt->bind_param('i', $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

// Return the details of the book as a JSON object
echo json_encode($book);
?>
