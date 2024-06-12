
<?php
// if(session_status()=="PHP_SESSION_ACTIVE"){
//     session_start();
//     session_unset();
//     session_destroy();
//     }
if(isset($_GET['err'])){
    echo "<script>alert('username or password are incorrect')</script>";
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            margin:0px;
            padding:0px;
        }
    </style>
</head>
<body class="homepage">
    <?php
    include("root.php");
    ?>

    <div id="regpage"><h1  style="color:brown;background-color:white;border:3px solid brown;border-radius:5px">ADMIN LOGIN</h1>

<div id="content-wrapper" class="homepage">
    <form action = "aloginprocess.php" method="post">
    <div class="regfield">
        <label for="email">Email</label>
        <input type="email" name = 'email' required>
    </div>

    <div class="regfield">
        <label for="pwd">Password</label>
        <input type="password" name = "pwd" required>
    </div>

    <div class="regfield">
        <input type="submit">
    </div>


    </form>
    </div>

</div>
</body>
</html>

<?php
?>