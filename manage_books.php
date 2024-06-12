    <!-- Bid
        Title
        AuthorId
        CatId
        isbn
        Image
        Price -->


<head>
    <style>
/* Table Styling */
#dataTables-example {
  border-collapse: collapse;
  width: 100%;
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  color: #444444;
  border: 1px solid #e6e6e6;
  background-color: #fff;
}

#dataTables-example th,
#dataTables-example td {
  border: 1px solid #e6e6e6;
  padding: 12px;
  text-align: left;
}

#dataTables-example th {
  background-color: #f7f7f7;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 0.8rem;
  color: #777777;
}

#dataTables-example tbody tr:nth-child(odd) {
  background-color: #f7f7f7;
}

#dataTables-example tbody tr:hover {
  background-color: #f2f2f2;
}

/* Pagination Styling */
#dataTables-example .pagination {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

#dataTables-example .pagination li {
  list-style: none;
  margin-right: 5px;
}

#dataTables-example .pagination li a {
  color: #555555;
  display: block;
  padding: 8px 16px;
  text-decoration: none;
  background-color: #ffffff;
  border: 1px solid #e6e6e6;
  border-radius: 50px;
  font-size: 0.8rem;
  transition: background-color 0.2s ease-in-out;
}

#dataTables-example .pagination li.active a {
  background-color: #007bff;
  color: #ffffff;
  border-color: #007bff;
}

#dataTables-example .pagination li.disabled a {
  color: #bbbbbb;
  cursor: default;
}

#dataTables-example .paginate_button {
  background-color: #ffffff;
  border: 1px solid #e6e6e6;
  color: #555555;
  cursor: pointer;
  display: inline-block;
  padding: 8px 16px;
  text-decoration: none;
  margin-right: 5px;
  border-radius: 50px;
  font-size: 0.8rem;
  transition: background-color 0.2s ease-in-out;
}

#dataTables-example .paginate_button.current {
  background-color: #007bff;
  color: #ffffff;
  border-color: #007bff;
}

#dataTables-example .paginate_button.disabled {
  color: #bbbbbb;
  cursor: default;
}

#dataTables-example .dataTables_length select {
  background-color: #ffffff;
  border: 1px solid #e6e6e6;
  color: #555555;
  border-radius: 50px;
  font-size: 0.8rem;
  transition: background-color 0.2s ease-in-out;
}

#dataTables-example .dataTables_length select:hover,
#dataTables-example .dataTables_length select:focus {
  background-color: #f2f2f2;
}

.styled-button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 9px 22px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.btn-danger{
  background-color: red; /* Green */
  border: none;
  color: white;
  padding: 9px 22px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
body {
  margin: 0px;
  padding: 0px;
  background-color: #DCDCFA;
}


    </style>
    <!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include the DataTables plugin -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>

<?php
ob_start();
session_start();
if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}

// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','demo');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

include("root.php");

$con = mysqli_connect("localhost","root","","demo");
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from books  WHERE Bid=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:manage_books.php');

}


$result = mysqli_query($con,"SELECT books.Title,books.isbn,books.Image,books.Price,books.Bid, (SELECT athours.AuthorName FROM athours WHERE athours.Authorid = books.AuthorId) AS author_name, (SELECT categories.CatName FROM categories WHERE categories.CatId = books.CatId) AS category_name FROM books;");
?>

<div style="width:80%;margin:30px auto;border: 3px solid #e6e6e6;background-color:#ffffff;padding:8px;">
<center><h3 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">MANAGE BOOKS</h3></center>

<table id="dataTables-example">
    <thead>
        <th>#</th>
        <th>Image</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>ISBN</th>

        <th>Price</th>
        <th>Action</th>
    </thead>
    <tbody>
    <?php
    $It = 1;

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" .$It++. "</td>";
    echo "<td><img src='" .$row['Image']. "' alt = 'bookimage' height = '70px' width = '70px'></td>";

    echo "<td>" .$row['Title']. "</td>";
    echo "<td>" .$row['author_name']. "</td>";
    echo "<td>" .$row['category_name']. "</td>";
    echo "<td>" .$row['isbn']. "</td>";
    echo "<td>" .$row['Price']. "</td>";
    echo "<td>". "<a href='edit_book.php?Bid=".$row['Bid']."'><button class = 'styled-button'>Edit Book</button></a>";
    ?>
    <a href="manage_books.php?del=<?php echo htmlentities($row['Bid']);?>'" onclick="return confirm('Are you sure you want to delete?');" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>

    <?php
    echo "</td></tr>";
}

?>
<a href=""></a>
    </tbody>
</table>
</div>
<script>
    $(document).ready(function() {
  $('#dataTables-example').DataTable();
});


// Get the table element
var table = document.getElementById("dataTables-example");

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



