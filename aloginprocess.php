<?php



$admin_email = $_POST['email'];
$admin_password = $_POST['pwd'];

$server = "localhost";
$username = "root";
$dbpassword = "";
$db = "demo";

$con = mysqli_connect($server,$username,$dbpassword,$db);

$sql = "SELECT * FROM `admins` WHERE `email`='$admin_email' and `password`='$admin_password'";

$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)==1){
    session_start();
    $row = $result->fetch_assoc();

    $_SESSION['admin-aid'] = $row['aid'];
    $_SESSION['admin-name'] = $row['admin_name'];
    $_SESSION['admin-email'] = $row['email'];
    $_SESSION['admin-phno'] = $row['phone_number'];
    $_SESSION['alogin'] = true;
    unset($_SESSION['ulogin']);

    header("Location:dashboard.php");
    die();
}else{
    header("location:adminlogin.php?err=unsecc");
    die();
}


?>