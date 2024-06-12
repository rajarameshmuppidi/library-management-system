<head>
    <link rel="stylesheet" href="tablestyle.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include the DataTables plugin -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<style>

  body{
    background-color: #DCDCFA;
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

</style>
</head>


<?php
session_start();
include("root.php");


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
$sql = "delete from categories  WHERE CatId=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:categories.php');

}

$con  = mysqli_connect("localhost","root","","demo");

$result= mysqli_query($con,"select * from `categories`");



?>

<div style="width:80%;margin:30px auto;border: 1px solid #e6e6e6;;padding:8px;background-color:#ffffff;"> 
<center><h3 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">MANAGE CATEGORIES</h3></center>

<table id="dataTables-example">
    <thead>
        <th>CatId</th><th>Catogory name</th><th>Category Status</th><th>Creation Date</th><th>Updation Date</th><th>action</th>
    </thead>
<tbody>
    <?php
        while($row = $result->fetch_assoc()){
            echo "<tr><td>".$row["CatId"]."</td><td>".$row['CatName']."</td><td>".$row['Status']."</td><td>".$row['CreationDate']."</td><td>".$row['UpdationDate']."</td><td><a href='chatgpt5.php?CatId=".$row['CatId']."' ><button class='styled-button'>Edit</button></a>";
            ?>

<a href="categories.php?del=<?php echo htmlentities($row['CatId']);?>'" onclick="return confirm('Are you sure you want to delete?');" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>


            <?php
            echo "</td></tr>";
        }
        
    ?>
</tbody>
</table>

<br>
<br>
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



