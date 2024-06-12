<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
  
  margin: 0;
  padding: 0;
}
    </style>
</head>
<body>
    <?php
    session_start();
    include("root.php");
    if(!isset($_SESSION['alogin'])){
        header("location:adminlogin.php");
      }
    ?>
    <div id="regpage">
    <h1>Add Category</h1>

    <div class="homepage" id="content-wrapper">
        <form action="insert_category.php" method="post">
        <div class="regfield">
            <label for="category">Enter category<span style="color: red;">*</span></label>
            <input type="text" name="category" id="category" required>
        </div>
        <div class="regfield">
            <label for="status">Status</label>
            <input type="radio" name="status" id="status" value=1 checked>Active
        </div>
        <div class="regfield">
            <label for="nothing"></label>
            <input type="radio" name="status" id = "status" value = 0>Inactive 
        </div>
        <div>
            <label for=""></label>
            <input type="submit" value = "ADD">
        </div>
        </form>
    </div>
    </div>
</body>
</html>