<head>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body class="dashboard">
    
</body>
<?php
session_start();
include("root.php");

if(isset($_SESSION['ulogin'])){   
?>

<div id="regpage">
<h1 style="color:black">Change password to user</h1>

<div id="content-wrapper" class="homepage">
<form action="updatepassword.php" method="post">
<div class="regfield">
<label for="fullname">Fullname:</label>
<input type="text" name = "fullname" value = <?php echo $_SESSION['user-email']?> fix>
</div>
<div class="regfield">
<label for="oldpassword">Enter old password</label>
<input type="text" name = "opwd">
</div>
<div class="regfield">
<label for="newpassword">Enter new password</label>
<input type="text" name = 'npwd'>
</div>
<div class="regfield">
<label for="confirmpassword">Confirm new password</label>
<input type="password" name = "cpwd">
</div>
<div class="regfield">
    <label for="nothing"></label>
    <input type="submit" value="submit" name = "submit">
</div>
</div>
</form>

</div>
<?php
}elseif($_SESSION['alogin']){
?>

<div id="regpage">
<h1 style="color:black">Change password</h1>

<div id="content-wrapper" class="homepage">
<form action="updatepassword.php" method="post">
<div class="regfield">
<label for="fullname">Fullname:</label>
<input type="text" name = "fullname" value = <?php echo $_SESSION['admin-name']?> >
</div>
<div class="regfield">
<label for="oldpassword">Enter old password</label>
<input type="text" name = "opwd">
</div>
<div class="regfield">
<label for="newpassword">Enter new password</label>
<input type="text" name = 'npwd'>
</div>
<div class="regfield">
<label for="confirmpassword">Confirm new password</label>
<input type="password" name = "cpwd">
</div>
<div class="regfield">
    <label for="nothing"></label>
    <input type="submit" value="submit" name = "submit">
</div>
</div>
</form>

</div>

<?php
}
if(!isset($_SESSION['ulogin']) && !isset($_SESSION['alogin'])){
    header("location:login.php");
    die();
  }
?>