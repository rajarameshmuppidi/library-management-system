<!DOCTYPE html>
<html>
<head>
  <title>Update Book</title>
  <style>
    /* Reset default styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Set font and background colors */
    body {
      font-family: Arial, sans-serif;
      color: #333;
      background-color: #f2f2f2;
    }

    /* Center content */
    .content-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Add modern aesthetics to form */
    form {
      display: grid;
      grid-template-columns: 1fr;
      grid-row-gap: 1rem;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
    }

    label {
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    input[type="text"],
    input[type="file"] {
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-size: 1rem;
      width: 100%;
    }

    input[type="submit"] {
      padding: 0.5rem;
      background-color: #2ecc71;
      color: #fff;
      border: none;
      border-radius: 3px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #27ae60;
    }

    .book-image {
      max-width: 200px;
      max-height: 200px;
      object-fit: cover;
      margin-bottom: 1rem;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <?php
   session_start();
   include("root.php");
  ?>
  <div class="content-wrapper">
    <form method="post" enctype="multipart/form-data">
      <h1>Change Image of Book</h1>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        // Get the form data
        $Title = $_POST['Title'];
        $isbn = $_POST['isbn'];

        // Generate a unique name for the image based on the current timestamp
        $imageName = time() . "_" . $_FILES['Image']['name'];

        // Move the uploaded file to the uploads folder with the unique name
        move_uploaded_file($_FILES['Image']['tmp_name'], 'uploads/' . $imageName);

        // Update the book data in the database
        $sql = "UPDATE books SET Title='$Title', isbn='$isbn', Image='uploads/$imageName' WHERE Bid=$Bid";

        if    (mysqli_query($conn, $sql)) {
            // If the update is successful, redirect to the updated book page
            header("Location: edit_book.php?Bid=$Bid");
            exit();
          } else {
            // If there's an error, display the error message
            echo "Error updating record: " . mysqli_error($conn);
          }
      
          // Close the database connection
          mysqli_close($conn);
        } else {
          // If the form hasn't been submitted, display the book data
      
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
      
          // Get the book data from the database
          $sql = "SELECT * FROM books WHERE Bid=$Bid";
          $result = mysqli_query($conn, $sql);
      
          if (mysqli_num_rows($result) > 0) {
            // If the book exists, display the data in the form
            $row = mysqli_fetch_assoc($result);
            $Title = $row['Title'];
            $isbn = $row['isbn'];
            $Image = $row['Image'];
          } else {
            // If the book doesn't exist, display an error message
            echo "Book not found";
          }
      
          // Close the database connection
          mysqli_close($conn);
        }
        ?>
        <div>
          <label for="Title">Title</label>
          <input type="text" id="Title" name="Title" value="<?php echo $Title; ?>" required>
        </div>
        <div>
          <label for="isbn">ISBN</label>
          <input type="text" id="isbn" name="isbn" value="<?php echo $isbn; ?>" required>
        </div>
        Previous Image
        <div>
        
        <?php if (!empty($Image)): ?>
            
            <img class="book-image" src="<?php echo $Image; ?>" alt="Book Image" >
          <?php endif; ?>
          <br>
          <label for="Image">Image</label>
          <input type="file" id="Image" name="Image" required>
          
        </div>
        <div>
          <input type="submit" value="Update Book">
        </div>
      </form>
      </div>
</body>
</html>      
