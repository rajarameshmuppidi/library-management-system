<?php

$image = $_FILES['image'];
$title = $_POST['title'];
$authId = $_POST['authId'];
$CatId = $_POST['catId'];
$isbn = $_POST['isbn'];
$Price = $_POST['price'];

$fileName = $_FILES['image']['name'];
$fileTmp = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$fileType = $_FILES['image']['type'];
$fileError = $_FILES['image']['error'];
// print_r($_FILES['image']);

echo $fileName."<br>".$fileTmp."<br>".$fileSize."<br>".$fileType."<br>".$fileError."<br>";


print_r($image);
echo "<br>";

$fileExt = explode('.',$fileName);
$fileActExt = strtolower($fileExt[1]);
print_r($fileActExt);

$allowed = array("jpg",'jpeg','png');

if(in_array($fileActExt,$allowed)){
    $a = 0;
    echo "<br><br><br>This is working...";
    if($fileError===0){
        if($fileSize<100000000){
            $fileNewName = uniqid('',true).".".$fileActExt;
            $fileDest = "uploads/".$fileNewName;
            if(move_uploaded_file($fileTmp,$fileDest)){
                ////////write insertion code here///////////

                $sql = "INSERT INTO `books`( `Title`, `AuthorId`, `CatId`, `isbn`, `Image`, `Price`) VALUES ('$title','$authId','$CatId','$isbn','$fileDest','$Price')";

                $con2 = mysqli_connect("localhost","root","","demo");

                $result2 = mysqli_query($con2,$sql);

                if($result2){
                    echo "<br>inserted book information successfully...";
                    header("Location:getbooks.php/?msg=succ");
                }


            };

            echo "<br> moved successfully...";
        }
    }


}


?>