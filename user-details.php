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
	<title>User Details</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
	<style>
		.container {
			margin-top: 50px;
			text-align: left;
		}
		h1 {
			background-color: #007bff;
			color: #fff;
			padding: 10px;
			width:50%;
      		font-size: medium;
			margin-bottom: 10px;
			margin: 10px auto;
		}
		.btn-primary {
			background-color: #007bff;
			border-color: #007bff;
		}
	</style>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "demo";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sid = $_GET['sid'];

		$sql = "SELECT * FROM users WHERE sid='$sid'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$sid = $row['sid'];
				$sname = $row['sname'];
				$email = $row['email'];
				$phone_number = $row['phone_number'];
				$date_of_regd = $row['date_of_regd'];
				$is_faculty = $row['is_faculty'];
				$status = $row['status'];
			}
		}
	?>

	<div class="container">
		<h1>My Profile</h1>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<table class="table">
					<tbody>
						<tr>
							<th>SID:</th>
							<td><?php echo $sid; ?></td>
						</tr>
						<tr>
							<th>Name:</th>
							<td><?php echo $sname; ?></td>
						</tr>
						<tr>
							<th>Email:</th>
							<td><?php echo $email; ?></td>
						</tr>
						<tr>
							<th>Phone Number:</th>
							<td><?php echo $phone_number; ?></td>
						</tr>
						<tr>
							<th>Date of Registration:</th>
							<td><?php echo $date_of_regd; ?></td>
						</tr>
						<tr>
							<th>Is Faculty:</th>
							<td><?php if($is_faculty==1) {echo 'True';} else{ echo 'False';} ?></td>
						</tr>
						<tr>
							<th>Status:</th>
							<td><?php if($status==1) {echo 'Active';} else{} ?></td>
						</tr>
					</tbody>
				</table>
				<a href="userdashboard.php" class="btn btn-primary">User Dashboard</a>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

