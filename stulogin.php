<?php

$email = $_POST['email'];
$password = $_POST['pwd'];


$server = "localhost";
$username = "root";
$dbpwd = "";
$db = "demo";

$con = mysqli_connect($server,$username,$dbpwd,$db);

$sql = "SELECT * FROM `users` WHERE `email` = '$email' and `pwd`='$password';";

$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)==1){
    session_start();

    $row = $result->fetch_assoc();

    $_SESSION['ulogin'] = true;
    
    $_SESSION['user-email'] = $row['email'];
    
    $_SESSION['user-name'] = $row['sname'];
    
    $_SESSION['user-sid'] = $row['sid'];
    
    $_SESSION['user-phno'] = $row['phone_number'];
}
else{
    header("Location:login.php?err=crederror");
    die();
}

header("Location:userdashboard.php");
die();
?>
