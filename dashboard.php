
<head>
<base href="http://localhost/project/">
<style>
    main{
        background-color: #DCDCFA;
        padding-top: 5px;
    }
    body{
        background-color: #DCDCFA;
    }
</style>
</head>


<?php

session_start();

if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}


include("root.php");
if(isset($_GET['msg'])){
    if($_GET['msg']=="ups"){
        echo "updated successfully...";
    }
    elseif($_GET['msg']=="err"){
        echo "enterd old password is incorrect";
    }
}



$con = mysqli_connect("localhost","root","","demo");

$result1 = mysqli_query($con,"select count(*) as count from books");
$result2 = mysqli_query($con,"select count(*) as count from users");
$result3 = mysqli_query($con,"select count(*) as count from issuedbookdetails where ReturnStatus=0");

$result4 = mysqli_query($con,"select count(*) as count from athours");

$result5 = mysqli_query($con,"select count(*) as count from categories");

$books = mysqli_fetch_assoc($result1);
$users = mysqli_fetch_assoc($result2);

$notreturned = mysqli_fetch_assoc($result3);

$authors = mysqli_fetch_assoc($result4);

$categories = mysqli_fetch_assoc($result5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Library Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
</head>
<body>
  <header>
  </header>

  <main>
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Books Listed<?PHP echo " : ".$books['count']?></h5>
              <p class="card-text">View and manage all books listed in the library.</p>
              <a href="manage_books.php" class="btn btn-primary">
                <i class="bi bi-book"></i>
                View Books
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Books Not Returned<?PHP echo " : ".$notreturned['count']?></h5>
              <p class="card-text">View and manage all books that are currently not returned by users.</p>
              <a href="manage_issued_book.php" class="btn btn-danger">
                <i class="bi bi-exclamation-triangle"></i>
                View Books
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
  <div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title">Registered Users<?PHP echo " : ".$users['count']?></h5>
      <p class="card-text">View and manage all registered users of the library.</p>
      <a href="regstudents.php" class="btn btn-success">
        <i class="bi bi-people"></i>
        View Users
      </a>
    </div>
  </div>
</div>

    <div class="col-md-6 col-lg-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Authors Listed<?PHP echo " : ".$authors['count']?></h5>
          <p class="card-text">View and manage all authors listed in the library.</p>
          <a href="authors.php" class="btn btn-info">
            <i class="bi bi-person"></i>
            View Authors
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Listed Categories<?PHP echo " : ".$categories['count']?></h5>
          <p class="card-text">View and manage all categories listed in the library.</p>
          <a href="categories.php" class="btn btn-warning">
            <i class="bi bi-folder"></i>
            View Categories
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>