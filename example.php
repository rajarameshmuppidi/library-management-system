<?php
$con = mysqli_connect("localhost","root","","demo");
$sql = "SELECT  `url` FROM `images` WHERE `image_id`=26";

$res = mysqli_query($con,$sql);
$row = $res->fetch_assoc();

?>


<img src="
<?php

echo $row['url'];

?>

" alt="">