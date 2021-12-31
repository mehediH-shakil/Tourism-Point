<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'tourism_point');
if (!$conn) {
	die("Connection Error");
}
// $ID = $_SESSION['$packageID'];
echo "$ID";
?>
