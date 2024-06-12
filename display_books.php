<?php

$con = mysqli_connect("localhost",'root',"","demo");

$result = mysqli_query($con,"select * from `books`");


while($row = $result->fetch_assoc()){
    echo "<img src = '".$row['Image']."'alt='this is an image' height = '170px' width = '130px'>";
}

?>