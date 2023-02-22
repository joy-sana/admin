<?php

session_start();
unset($_SESSION["none"]);
session_destroy();

header("Location: signin_admin.php");

?>