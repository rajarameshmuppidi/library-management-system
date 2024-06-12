<?php
if(session_status()=="PHP_SESSION_ACTIVE"){
session_start();
session_unset();
session_destroy();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
   
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    <base href="http://localhost/project/">
</head>
<body class="homepage">
    <?php
    include('root.php');
    ?>

<div id = "regpage">
<?php
if(isset($_GET['err'])){
    if($_GET['err']=='aar'){
        echo "<h3 style='color:red'>Account Already existed</h3>";
    }
    elseif($_GET['err']=='crederror'){
        echo "<h3 style='color:red'>Username or Password are Wrong</h3>";
    }
    elseif($_GET['err']=='acs'){
        echo "<h3 style='color:green'>Account created successfully...</h3>";
    }
    }
    elseif(isset($_GET['sid'])){
        echo "<script>alert('your SID is ".$_GET['sid']."')</script>";
    }
?>

<h1 style="color:brown;background-color:white;border:3px solid brown;border-radius:5px">USER LOGIN</h1>
<div id="regpage">
<div id="content-wrapper" class="homepage">
    <form action = "stulogin.php" method = "post">
    <div class="regfield">
        <label for="email">Email</label>
        <input type="email" name = 'email' id='email' required>
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
    

</div>

<?php
    include("footer.php");
    ?>
</body>
</html>

<?php
// session_start();
// if(isset($_SESSION['user-email'])){
//     echo "<h1>".$_SESSION['user-email']."</h1>";
// }

?>