<?php
if(isset($_POST['login'])){
    $con = mysqli_connect("localhost","root","","raja");
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $sql = "select * from `users` where `username` = '$username' and `password`='$pwd'";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user-name'] = $row['username'];
    }
    $con->close();
}
if(isset($_SESSION['user-name'])){
    echo "<h2>hi.......".$_SESSION['user-name']."</h2>";
}
else{
?>

<form action="" method="post">
    usename : <input type="text" name = "username"><br>
    password : <input type="text" name = "password"><br>
    <input type="submit" name = "login">
</form>


<?php
}
?>