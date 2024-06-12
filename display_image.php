<?php
// Connect to the database
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
$conn = mysqli_connect('localhost', 'root', '', 'demo');

// Check if the connection was successful
if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

// Get the image ID from the URL parameter
$imageId = $_GET['image_id'];

// Retrieve the image data from the database
$sql = "SELECT * FROM images WHERE image_id = $imageId";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if($result && mysqli_num_rows($result) > 0){
  
  // Get the image data
  $row = mysqli_fetch_assoc($result);
  $imgData = $row['data'];
  
  // Display the image
  header("Content-type: image/jpg");
  echo stripslashes($imgData);
  
} else {
  echo "Image not found.";
}

// Close the database connection
mysqli_close($conn);
?>
