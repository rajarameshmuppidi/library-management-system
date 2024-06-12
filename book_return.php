<head>
	<style>
		label{
			display: inline-block;
			width: 190px;
			font-size: large;
			font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
			margin-bottom: 10px;
			font-weight: normal;
		}
		.info{
			font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
		.container{
			display: flex;
			flex-direction: row;
			align-items: baseline;
			justify-content: center;
			font-weight: bold;

		}
		.student-details,.book-details{
			margin:15px;
			border: 2px solid #ccc;
			padding: 15px;
			height: 40vh;
		}
		.info img{
			width: 15vh;
			border-radius: 5px;
		}
		.container h3{
			color: green;
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		}
		.get-fine{
			display: flex;
			align-items: center;
			justify-content: space-around;
			border: 2px solid #ccc;
			padding: 15px;
			width: 42%;
			margin: 10px auto;
		}
		.get-fine button{
			padding: 7px;
			font-size: large;
			background-color: dodgerblue;
			border: none;
			border-radius: 5px;
		}
		.get-fine button:hover{
			border: 2px solid blue;
			padding:5px;
		}
		input[type="text"],
input[type="password"],
input,
select,
textarea {
  box-sizing: border-box;
  padding: 5px;
  border: 2px solid #ccc;
  border-radius: 3px;
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: black;
  background-color: #fff;
  transition: border-color 0.2s ease-in-out;
}

input[type="text"]:focus,
input[type="password"]:focus,
input:focus,
select:focus,
textarea:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 5px #007bff;
}

	</style>
</head>
<?php
session_start();
include("root.php");
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "demo");

// Check if the connection was successful
$id = $_GET['id'];
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query the database to get the details of issued books
$sql = "SELECT issuedbookdetails.id,issuedbookdetails.Bid,issuedbookdetails.sid, users.sname AS StudentName,books.isbn AS isbn, books.Title AS BookTitle, issuedbookdetails.IssueDate, issuedbookdetails.ReturnDate, issuedbookdetails.ReturnStatus FROM issuedbookdetails 
        INNER JOIN users ON issuedbookdetails.sid = users.sid 
        INNER JOIN books ON issuedbookdetails.Bid = books.Bid where issuedbookdetails.id='$id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$sid = $row['sid'];
$id = $row['id'];

$result2 = mysqli_query($conn,"select * from users where sid = '$sid'");

$user = mysqli_fetch_assoc($result2);

?>

<div class="container">
	<div class="student-details">
		<h3>Student Details</h3>
		<div class="info">
			<label for="">studen id</label>: <?php echo $user['sid'] ?>
		</div>
		
		<div class="info">
			<label for="">student name</label>: <?php echo $user['sname'] ?>
		</div>
		<div class="info">
			<label for="">Student email id</label>: <?php echo $user['email'] ?>
		</div>
		<div class="info">
			<label for="">student contact numnber</label>: <?php echo $user['phone_number'] ?>
		</div>
		
	</div>

		<div class="book-details">
			<h3>Book Details</h3>

			<div class="info">
				<label for="">book id</label>: <?php echo $row['Bid'] ?>
			</div>

			<div class="info">
				<img src="uploads/1681451996_avatar.jpg" alt="">
			</div>

			<div class="info">
				<label for="">title</label>: <?php echo $row['BookTitle'] ?>
			</div>
			<div class="info">
				<label for="">issued date</label>: <?php echo $row['IssueDate'] ?>
			</div>
			<div class="info">
				<label for="">returned date</label>: <?php if($row['ReturnStatus']){echo $row['ReturnDate'];}else echo "not yet returned" ?>
			</div>
			
	</div>
</div>


<?php
if($row['ReturnStatus']==0){
?>
<div class="get-fine">
	<form action="return_process.php">
<div>
	<label for="">Enter Fine Amount</label>:
	<input type="number" name="fine">
	<input type="number" name = "id" style="display:none" value="<?php echo $id?>">
</div>
<label for=""></label>
	<button type="submit">Returned</button>
</div>
</form>
<?php
}
?>