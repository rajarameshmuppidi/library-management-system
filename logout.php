<?php

// session_destroy();
// $_SESSION = array();

session_start();

session_unset();

// destroy the session
session_destroy();

header("Location:login.php");
?>

