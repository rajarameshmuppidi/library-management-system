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


.status-button {
  border: none;
  padding: 5px 10px;
  color: white;
  cursor: pointer;
  border-radius: 5px;
}

.active-button {
  background-color: #4CAF50;
}

.inactive-button {
  background-color: #f44336;
}
body{
  margin: 0px;
  padding:0px;
  background-color: #DCDCFA;
}
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


</head>



<?php
// Connect to the database
session_start();
include('root.php');
if(!isset($_SESSION['alogin'])){
  header("location:adminlogin.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";
?>
<div style="width:80%;margin:30px auto;border: 1px solid #e6e6e6;background-color:white;padding:8px;">
<center><h3 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">MANAGE REGISTERED USERS</h3></center>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user details from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);



// Display user details in a table
echo "<table  id = 'dataTables-example'>";
echo "<thead><th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Is Faculty</th><th>Status</th></thead><tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["sid"] . "</td>";
    echo "<td>" . $row["sname"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["phone_number"] . "</td>";
    echo "<td>" . ($row["is_faculty"] ? "Yes" : "No") . "</td>";
    echo '<td><button class="status-button" data-user-id="' . $row["sid"] . '" data-status="' . $row["status"] . '" style ="background-color:'. ($row["status"] ? "#4CAF50" : "#f44336").'">' . ($row["status"] ? "Active" : "Inactive") . '</button></td>';
    echo "</tr>";
}
echo "</tbody></table>";

?>
</div>
<script>
    // Get all the status buttons
var statusButtons = document.getElementsByClassName("status-button");

// Loop through each button
for (var i = 0; i < statusButtons.length; i++) {
  // Add a click event listener to each button
  statusButtons[i].addEventListener("click", function() {
    // Get the current status of the button
    var currentStatus = this.dataset.status;
    // Toggle the status value
    var newStatus = currentStatus == "1" ? "0" : "1";
    // Update the button text and color
    if (newStatus == "1") {
      this.innerText = "Active";
      this.style.backgroundColor = "#4CAF50";
      this.dataset.status = "1";
    } else {
      this.innerText = "Inactive";
      this.style.backgroundColor = "#f44336";
      this.dataset.status = "0";
    }
    // Get the user ID from the button's data attribute
    var userId = this.dataset.userId;
    // Send an AJAX request to update the status in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Successfully updated the status in the database
        } else {
          alert("not updated in the database..."+xhr.status);
        }
      }
    };
    xhr.send("userId=" + userId + "&status=" + newStatus);
  });

}


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





