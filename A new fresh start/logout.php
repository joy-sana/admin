<?php
$message="Successfully Logged out";
echo "<script>alert('$message');</script>";

session_start();
unset($_SESSION["none"]);
session_destroy();

header("Location: signin.php");

?>