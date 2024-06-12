<?php

session_start();
include("root.php");

if(!isset($_SESSION['ulogin'])){
  header("location:login.php");
  die();
}

?>

<?php
// establish mysqli connection
$mysqli = new mysqli("localhost", "root", null, "demo");

// check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

// query to count number of books in books table
$books_query = "SELECT COUNT(*) AS books_count FROM books";

// execute query
$books_result = $mysqli->query($books_query);

// fetch result
$books_count = $books_result->fetch_assoc()['books_count'];
$sid = $_SESSION['user-sid'];

// query to count number of records in issuedbookdetails table
$not_returned_query = "SELECT COUNT(*) AS not_returned FROM issuedbookdetails WHERE sid = '$sid' AND ReturnStatus = 0";

// execute query
$not_returned_result = $mysqli->query($not_returned_query);

// fetch result
$not_returned = $not_returned_result->fetch_assoc()['not_returned'];

// display results
// close mysqli connection
$mysqli->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- Custom CSS -->
  <style>

  /* Scale Effect */
  a:hover {
    transform: scale(1.05);
	text-decoration: none;
  }

  /* Fade-In Effect */
  a {
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
  }
  a:hover {
    opacity: 0.8;
  }

  /* Underline Effect */
  a {
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease-in-out;
  }
  a::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #000;
    visibility: hidden;
    transform: scaleX(0);
    transition: all 0.3s ease-in-out;
  }
  a:hover::before {
    visibility: visible;
    transform: scaleX(1);
  }
</style>

</head>
<body>
  <div class="container mt-5">
    <h1 class="text-center">User Dashboard</h1>
    <div class="row mt-5">
      <div class="col-md-4 mb-4">
        <a href="books-listed.php" class="d-block text-center p-4 border rounded-lg">
          <i class="fas fa-book fa-3x mb-3"></i>
          <h1><?php echo $books_count ?></h1>
          <h4 class="mb-0">Books Listed</h4>
        </a>
      </div>
      <div class="col-md-4 mb-4">
        <a href="<?php echo 'issued-books.php?sid='.$_SESSION['user-sid']?>" class="d-block text-center p-4 border rounded-lg">
          <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
          <h1><?php echo $not_returned ?></h1>
          <h4 class="mb-0">Books Not Returned</h4>
        </a>
      </div>
      <div class="col-md-4 mb-4">
        <a href="<?php echo 'issued-books.php?sid='.$_SESSION['user-sid']?>" class="d-block text-center p-4 border rounded-lg">
          <i class="fas fa-history fa-3x mb-3"></i>
          <h1 ></h1>
          <h4 class="mb-0">Issued Books in the Past</h4>
        </a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popperjs-core.min.js"
    integrity="sha256-xmVw8c4WgbbV7ogIXnhAfvkpf7QXkWd0q3Okrz/3HvI=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
