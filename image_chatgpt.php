<?php
// Check if the form has been submitted
if(isset($_POST['submit'])){
  
  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'demo');
  
  // Check if the connection was successful
  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }
  
  // Get the image data
  $image = $_FILES['image']['tmp_name'];
  
  // Check if an image was uploaded
  if($image){
    
    // Read the image contents
    $imgContent = addslashes(file_get_contents($image));
    
    // Insert the image data into the database
    $sql = "INSERT INTO images (data) VALUES ('$imgContent')";
    if(mysqli_query($conn, $sql)){
      echo "Image uploaded successfully.";
    } else {
      echo "Error uploading image: " . mysqli_error($conn);
    }
    
  } else {
    echo "No image uploaded.";
  }
  
  // Close the database connection
  mysqli_close($conn);
  
}
?>

<form action="" method="POST" enctype="multipart/form-data">
  <input type="file" name="image">
  <input type="submit" name="submit" value="Upload">
</form>
<?php
// Check if the form has been submitted
if(isset($_POST['submit'])){
  
  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'demo');
  
  // Check if the connection was successful
  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }
  
  // Get the image data
  $image = $_FILES['image']['tmp_name'];
  
  // Check if an image was uploaded
  if($image){
    
    // Read the image contents
    $imgContent = addslashes(file_get_contents($image));
    
    // Insert the image data into the database
    $sql = "INSERT INTO images (data) VALUES ('$imgContent')";
    if(mysqli_query($conn, $sql)){
      echo "Image uploaded successfully.";
    } else {
      echo "Error uploading image: " . mysqli_error($conn);
    }
    
  } else {
    echo "No image uploaded.";
  }
  
  // Close the database connection
  mysqli_close($conn);
  
}
?>

<form action="" method="POST" enctype="multipart/form-data">
  <input type="file" name="image">
  <input type="submit" name="submit" value="Upload">
</form>
