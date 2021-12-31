<?php 
session_start();
$_SESSION['send1'] = "1";
header("location: profile.php");
?>