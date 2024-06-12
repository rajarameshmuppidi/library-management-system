<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "demo";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the Book ID (Bid) from the URL
  $Bid = $_GET['Bid'];

  // Get the image data from the uploaded file
  $Image = addslashes(file_get_contents($_FILES['Image']['tmp_name']));

  // Get the other data from the form
  $Title = $_POST['Title'];
  $isbn = $_POST['isbn'];

  // Move the uploaded image to the "uploads" folder with a unique name
  $target_dir = "uploads/";
  $target_file = $target_dir . time() . "_" . basename($_FILES["Image"]["name"]);
  move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);

  // Update the database with the new data and image filename
  $sql = "UPDATE books SET Image='$target_file', Title='$Title', isbn='$isbn' WHERE Bid='$Bid'";

  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }

  mysqli_close($conn);

} else {
  // Get the Book ID (Bid) from the URL
  $Bid = $_GET['Bid'];

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "demo";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the previous data from the database
  $sql = "SELECT * FROM books WHERE Bid='$Bid'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Output the previous data in a form
    $row = mysqli_fetch_assoc($result);
    echo "<form method='post' enctype='multipart/form-data'>";
    echo "Image: <input type='file' name='Image'><br>";
    echo "Title: <input type='text' name='Title' value='" . $row['Title'] . "'><br>";
    echo "ISBN: <input type='text' name='isbn' value='" . $row['isbn'] . "'><br>";
    echo "<input type='submit' value='Update'>";
    echo "</form>";
  } else {
    echo "No data found";
  }

  mysqli_close($conn);
}
?>
