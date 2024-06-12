<?php
session_start();
include("root.php");
if(!isset($_SESSION['ulogin'])){
  header("location:login.php");
  die();
}

  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "demo";

  // Create database connection
  $conn = mysqli_connect($host, $user, $password, $database);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Book Details</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }

      #book-table {
        
        margin: 0 auto;
        background-color: #fff;
        border-collapse: collapse;
        border: 1px solid #ddd;
      }

      #book-table th, #book-table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }

      #book-table tr:hover {
        background-color: #f5f5f5;
      }

      #book-table thead {
        background-color: #2196f3;
        color: #fff;
      }

      #book-table_wrapper {
        padding: 10px;
      }
    </style>
  </head>
  <body>
    <div style="width:60%;margin:10px auto">
    <table id="book-table">
      <thead>
        <tr>
          <th>Bid</th>
          <th>Image</th>
          <th>Title</th>
          <th>Author Name</th>
          <th>Category</th>
          <th>ISBN</th>
          
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
$query = "SELECT books.Bid, books.Title, athours.AuthorName, categories.CatName, books.isbn, books.Image, books.Price FROM books INNER JOIN athours ON books.AuthorId = athours.AuthorId INNER JOIN categories ON books.CatId = categories.CatId";          $result = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            
            echo "<td>".$row['Bid']."</td>";
            echo "<td><img src='".$row['Image']."' height='100' width='100'></td>";
            echo "<td>".$row['Title']."</td>";
            echo "<td>".$row['AuthorName']."</td>";
            echo "<td>".$row['CatName']."</td>";
            echo "<td>".$row['isbn']."</td>";
            
            echo "<td>".$row['Price']."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>

    </div>

    <script>
      $(document).ready(function() {
        $('#book-table').DataTable({
          "paging": true,
          "searching": true,
          "ordering": true,
          "info": true
        });
      });
    </script>
  </body>
</html>
