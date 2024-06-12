
<head>
    <base href="http://localhost/project/">
    <style>
        
        
body{
    margin: 0px;
    padding:0px;
}


    </style>

<link rel="stylesheet" href="style.css">
</head>


<?php

session_start();

include("root.php");
if(!isset($_SESSION['alogin'])){
    header("location:adminlogin.php");
  }

$con = mysqli_connect("localhost","root","","demo");

$result = mysqli_query($con,"select * from `athours`");

$con2 = mysqli_connect("localhost","root","","demo");

$result2 = mysqli_query($con,"select * from `categories`");


?>

<div id="regpage">
    <h1>Add Book</h1>

<div id="content-wrapper" class="homepage">

<form action="insert_book.php" method = "POST" enctype="multipart/form-data" >

    <div class = "regfield">
        <label for="Title">Enter Title of the Book</label>
        <input type="text" name = "title" required>
    </div>
    <div class="regfield">
        <label for="AuthorId">Select Author of the Book</label>
        <select name="authId" id="" required>
            <option value="">--select author--</option>
            <?php
              $table = $result->fetch_all();
              foreach($table as $row) {
                echo "<option value='".$row[0]."'>".$row[1]."</option>";
              } 
            ?>
        </select>
    </div>
    <div class="regfield">
        <label for="CatId">Select Category</label>
        <select name="catId" id="CatId">
            <option value="">--select category--</option>
        <?php
              $table = $result2->fetch_all();
              foreach($table as $row) {
                echo "<option value='".$row[0]."'>".$row[1]."</option>";

              } 
            ?>
        </select>
    </div>
    <div class = "regfield">
        <label for="ISBN">Enter ISBN</label>
        <input type="text" name = "isbn" >
    </div>
    <div class = "regfield">
        <label for="Image">Upload Image</label>
        <input type="file" name="image">
    </div>
    <div class="regfield">
        <label for="Price">Enter Price of the Book</label>
        <input type="number" name = "price">
    </div>
    <div class="regfield">
        <label for="nothing"></label>
        <input type="submit" name='submit'>
    </div>

</form>

</div>
</div>