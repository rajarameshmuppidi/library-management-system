<?php

    $name = $_POST['category'];
    $status = $_POST['status'];

    
    $con = mysqli_connect("localhost","root","","demo");
    $result = mysqli_query($con,"insert into `categories`(`CatName`,`Status`) values('$name','$status')");

    if($result){
        header("Location:categories.php");
        die();
    }
    else{
        echo "insertion is not possible";
    }

?>