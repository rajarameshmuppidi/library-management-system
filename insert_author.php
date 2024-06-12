<?php

    $name = $_POST['name'];
    $pass = "";
    $con = mysqli_connect("localhost","root",$pass,"demo");
    $result = mysqli_query($con,"insert into  `athours`(`AuthorName`) values ('$name')");

    if($result){
        header("Location:authors.php/?msg=succ");
    }
    else{
        echo "this is ridiculous";
        die();
    }


?>