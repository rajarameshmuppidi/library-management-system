<head>
<base href="http://localhost/project">
</head>

<?php

$sname = $_GET['fullname'];
$email = $_GET['email'];
$phone_number = $_GET['mobilenumber'];
$password = $_GET['pwd'];
$date_of_regd = date("Y-m-d");


if(isset($_GET['staff'])){
$is_faculty = true;
}
else{
    $is_faculty = false;
}

$con = mysqli_connect('localhost','root','','demo');

if($con->error){
    echo $con->error;
    die();
}else{
    echo "Connected Successfully...";
}

echo $is_faculty;

$sql = "SELECT `sid` FROM `users` WHERE `email` = '$email';";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)){
    echo "account already exists<br>";
    header("Location:login.php?err=aar",false);
    die();
}else{


$sql = "INSERT INTO `users`( `sname`, `email`, `phone_number`, `date_of_regd`, `is_faculty` ,`pwd`) VALUES ('$sname','$email','$phone_number','$date_of_regd','$is_faculty','$password')";

$con->execute_query($sql);

$result2= mysqli_query($con,"SELECT `sid` FROM `users` WHERE `email` = '$email';");
$row=mysqli_fetch_assoc($result2);
$sid=$row['sid'];
header("Location:login.php?sid=$sid",false);
die();

}

?> 