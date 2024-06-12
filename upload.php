<?php

    $fileName = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];
    print_r($_FILES['file']);
    
    echo "<br>";
    echo $fileName;
    echo $fileTmp;
    echo $fileSize;
    echo $fileType;
    echo $fileError;
    
    $fileExt = explode('.',$fileName);
    $fileActExt = strtolower($fileExt[1]);
    print_r($fileActExt);

    $allowed = array("jpg",'jpeg','png');

    if(in_array($fileActExt,$allowed)){
        echo "this is working";
        if($fileError===0){
            if($fileSize<1000000){
                $fileNewName = uniqid('',true).".".$fileActExt;
                $fileDest = "uploads/".$fileNewName;

                if(move_uploaded_file($fileTmp,$fileDest)){
                    if($con = mysqli_connect("localhost","root","","demo")){} else {echo "not possible";die();};
                    $sql = "INSERT INTO `images` (`url`) VALUES ('$fileDest');";
                    
                    mysqli_query($con,$sql);
                    echo "successfull";
                }else{
                    echo "not succesful";
                }


                //header("Location: chatgpt.html?msg=success");

            }else{
                echo "your file is too big";
            }

        }else{
            echo "error in a uploading files";
        }
    }else{
        echo "you cant upload ".$fileActExt." kind of files";
    }



?>