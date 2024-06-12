<?php
session_start();
if(isset($_SESSION['ulogin'])){
    $sid = $_SESSION['user-sid'];
    $server = "localhost";
    $username = "root";
    $dbpassword = "";
    $db = "demo";

    $con = mysqli_connect($server,$username,$dbpassword,$db);
    $opwd = $_POST['opwd'];
    $npwd = $_POST['npwd'];

    $sql = "SELECT `sid`, `pwd`FROM `users` WHERE `sid`='$sid' and `pwd`='$opwd'";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res)==1){
        $sql = "UPDATE `users` SET `pwd`='$npwd' WHERE `sid`='$sid'; ";
        $res2 = mysqli_query($con,$sql);
        if($res2){
        echo "<h1>your password changed successfully";
        header('Location:userdashboard.php/?msg=ups');
        die();
        }
    }
    else{
        header("Location:userdashboard.php/?msg=err");
        echo $_SESSION['uogin']."<br>";
        die();
    }
    
    
}elseif(isset($_SESSION['alogin'])){
echo "admin password change..";
$aid = $_SESSION['admin-aid'];
$server = "localhost";
$username = "root";
$dbpassword = "";
$db = "demo";

$con = mysqli_connect($server,$username,$dbpassword,$db);
$opwd = $_POST['opwd'];
$npwd = $_POST['npwd'];

$sql = "SELECT `aid`, `password` FROM `admins` WHERE `aid`='$aid' and `password`='$opwd'";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res)==1){
    $sql = "UPDATE `admins` SET `password`='$npwd' WHERE `aid`='$aid'; ";
    $res2 = mysqli_query($con,$sql);
    if($res2){
    echo "<h1>your password changed successfully";
    header('Location:dashboard.php/?msg=ups');
    die();
    }
}
header("Location:dashboard.php/?msg=err");
die();
}
else{
    header("Location:dashboard.php/?msg=err");
    echo $_SESSION['alogin']."<br>";
    die();
}


?>