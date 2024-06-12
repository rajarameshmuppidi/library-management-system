<head>
    <base href="http://localhost/project/">
</head>

<?php
ob_start();

$Bid = $_GET['Bid'];
$sid = $_GET['sid'];

$con = mysqli_connect("localhost","root","","demo");

$sql = "INSERT INTO `issuedbookdetails`( `Bid`, `sid`, `ReturnStatus`) VALUES ('$Bid','$sid','0')";

$result = mysqli_query($con,$sql);

if($result){
    echo "hi";
    $result2 = mysqli_query($con,"update books set `isIssued`=1 where `Bid`='$Bid'");
    header("location:issue_book.php?msg=succ");
    die();
}else{
    echo "error in insertion"; 
}

?>