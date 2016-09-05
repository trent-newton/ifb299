<?php
if(!isset($_SESSION['userID'])) //If a user is not logged in
{
	$_SESSION['error'] = "Please login to access this page.";
	header('location:../pages/login.php');
	exit();
} elseif(!($_SESSION['accountType'] == "Student") && !($_SESSION['accountType'] == "Teacher") && !($_SESSION['accountType'] == "StudentAndTeacher")) {
    $_SESSION['error'] = "Only Students or Teachers may access this page.";
	header('location:../pages/index.php');
	exit();
}
?>
