<head>
    <base href="http://localhost/project/">

    <link rel="stylesheet" href="tablestyle.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include the DataTables plugin -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<style>
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

body{
  background-color: #DCDCFA;
}
</style>
</head>


<?php

session_start();

include("root.php");

if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}

if(isset($_GET["msg"])){
    echo "<h1>added successfully...</h1>";
}


ob_start();


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



$con = mysqli_connect("localhost","root","","demo");
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from athours  WHERE AuthorId=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:authors.php');

}


$con = mysqli_connect("localhost","root","","demo");

$result = mysqli_query($con,"select * from `athours`");


$table = $result->fetch_all();

?>

<div style="width:80%;margin:30px auto;border: 1px solid #e6e6e6;;padding:8px;background-color:white">
<center><h3 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">MANAGE AUTHORS</h3></center>
<table id = "dataTables-example">
    <thead>
    <th>Author ID</th>
    <th>Author Name</th>
    <th>Creation Date</th>
    <th>Updation Date</th>
    <th>action</th>
    </thead>
    <tbody>
        <?php
    foreach($table as $row){
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>";
        
        ?>
        <a href="chatgpt6.php?AuthorId=<?php echo $row[0]?>"><button class="styled-button">Edit</button></a>
        <a href="authors.php?del=<?php echo htmlentities($row[0]);?>'" onclick="return confirm('Are you sure you want to delete?');" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
      
        <?php
        "</td></tr>";
    }?>
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







