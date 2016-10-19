<?php
if(!isset($_SESSION['userID'])) //If a user is not logged in
{
	$_SESSION['error'] = "Please login to access this page.";
	header('location:../login/login.php');
	exit();
}
?>
