<?php
session_start();
include("root.php");
if(!isset($_SESSION['ulogin'])){
  header("location:login.php");
  die();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Issued Book Details</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <style type="text/css">
    /* Center the table */
    #issued-books-table {
      margin-top: 10px;
    }

    /* Styling for the table */
    #issued-books-table th,
    #issued-books-table td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ddd;
    }

    #issued-books-table th {
      background-color: #eee;
    }
  </style>
</head>
<body>
  <div style="width:60%;margin:10px auto">
  <table id="issued-books-table" class="display">
    <thead>
      <h4>ISSUED BOOKS</h4>
      <tr>
        <th>ID</th>
        <th>Book Title</th>
        <th>Category</th>
        <th>ISBN</th>

        <th>Issue Date</th>
        <th>Return Date</th>
        <th>Return Status</th>
        <th>Fine</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "demo";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Get sid value from URL
      $sid = $_GET['sid'];

      // SQL query to retrieve data from the issuedbookdetails, books, categories, and users tables for the specified sid
      $sql = "SELECT ibd.id, b.Title, c.CatName, b.isbn, u.sname, ibd.IssueDate, ibd.ReturnDate, ibd.ReturnStatus, ibd.fine FROM issuedbookdetails ibd
        JOIN books b ON b.Bid = ibd.Bid
        JOIN categories c ON c.CatId = b.CatId
        JOIN users u ON u.sid = ibd.sid
        WHERE ibd.sid = $sid";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["Title"] . "</td>";
          echo "<td>" . $row["CatName"] . "</td>";
          echo "<td>" . $row["isbn"] . "</td>";

          echo "<td>" . $row["IssueDate"] . "</td>";
          echo "<td>" . $row["ReturnDate"] . "</td>";
          echo "<td>" . $row["ReturnStatus"] . "</td>";
          echo "<td>" . $row["fine"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "0 results";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
  </div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#issued-books-table').DataTable();
    });
  </script>
</body>
</html>

