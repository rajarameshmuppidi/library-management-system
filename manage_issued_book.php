<head>
    <style>
        /* Table styling */
#issued-books {
  border-collapse: collapse;
  width: 100%;
}

#issued-books td, #issued-books th {
  border: 1px solid #ddd;
  padding: 8px;
}

#issued-books th {
  background-color: #4CAF50;
  color: white;
  text-align: left;
}

#issued-books tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

#issued-books tbody tr:hover {
  background-color: #ddd;
}

/* DataTable plugin styling */
.dataTables_wrapper {
  font-family: Arial, sans-serif;
  font-size: 12px;
  line-height: 1.5;
  margin: 0 auto;
  max-width: 1300px;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
  display: inline-block;
  margin-bottom: 10px;
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input[type=search] {
  border-radius: 5px;
  border: 1px solid #ccc;
  padding: 5px;
  margin-left: 10px;
  font-size: 12px;
}

.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
  display: inline-block;
  margin-bottom: 10px;
}

.dataTables_wrapper .dataTables_paginate ul.pagination {
  margin: 0;
}

.dataTables_wrapper .dataTables_paginate ul.pagination li {
  display: inline-block;
  margin-right: 5px;
  border: 1px solid #ddd;
  padding: 5px;
}

.dataTables_wrapper .dataTables_paginate ul.pagination li.active {
  background-color: #4CAF50;
  color: white;
}

.dataTables_wrapper .dataTables_paginate ul.pagination li.disabled {
  opacity: 0.5;
  pointer-events: none;
}
td button{
  background-color: dodgerblue;
  border: 2px solid dodgerblue;
  padding: 5px 10px;
}
body{
  margin: 0px;
  padding: 0px;
  background-color: #DCDCFA;
}
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>   
</head>


<?php
// Connect to the database
ob_start();
session_start();
include("root.php");

if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}

$conn = mysqli_connect("localhost", "root", "", "demo");

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query the database to get the details of issued books
$sql = "SELECT issuedbookdetails.id,issuedbookdetails.Bid, users.sname AS StudentName,books.isbn AS isbn, books.Title AS BookTitle, issuedbookdetails.IssueDate, issuedbookdetails.ReturnDate, issuedbookdetails.ReturnStatus FROM issuedbookdetails 
        INNER JOIN users ON issuedbookdetails.sid = users.sid 
        INNER JOIN books ON issuedbookdetails.Bid = books.Bid";
$result = mysqli_query($conn, $sql);  

echo '<div style="border:1px solid #ccc;margin-left:auto;margin-right:auto;margin-top:30px;width:70%;padding:10px;background-color:white">';
?>
<center><h3 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">MANAGE ISSUED BOOKS</h3></center>

<?php
// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // Start the table and table header
  echo "<table id='issued-books' class='display'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Student Name</th>";
  echo "<th>BID</th>";
  echo "<th>Book Title</th>";
  echo "<th>ISBN</th>";
  echo "<th>Issue Date</th>";
  echo "<th>Return Date</th>";
  echo "<th>action</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";

  // Loop through the rows and display the data in the table
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['StudentName'] . "</td>";
    echo "<td>" . $row['Bid'] . "</td>";
    echo "<td>" . $row['BookTitle'] . "</td>";
    echo "<td>" . $row['isbn'] . "</td>";
    echo "<td>" . $row['IssueDate'] . "</td>";
    echo "<td>" ; if($row['ReturnStatus']){echo $row['ReturnDate'];}else{echo "Not Returned Yet";}  "</td>";

    echo "<td><a href='book_return.php?id=".$row['id'] . "'><button>Edit</button></a></td>";
    echo "</tr>";
  }

  // End the table and close the database connection
  echo "</tbody>";
  echo "</table>";
} else {
  echo "No records found.";
}

// Close the database connection
mysqli_close($conn);
?>
</div>

<script>
    
  $(document).ready(function() {
  $('#issued-books').DataTable();
});


// Get the table element
var table = document.getElementById("issued-books");

// Get all the table header cells
var headers = table.getElementsByTagName("th");

// Add an event listener to each header cell
for (var i = 0; i < headers.length; i++) {
  headers[i].addEventListener("click", function() {
    var rows = table.rows;
    var switching = true;
    var shouldSwitch;
    var column = this.cellIndex;

    while (switching) {
      switching = false;

      for (var i = 1; i < rows.length - 1; i++) {
        shouldSwitch = false;

        var x = rows[i].getElementsByTagName("td")[column];
        var y = rows[i + 1].getElementsByTagName("td")[column];

        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }

      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  });
}


</script>