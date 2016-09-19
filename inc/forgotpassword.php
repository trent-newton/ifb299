<?php
ob_start();
session_start();
include "../inc/connect.php";
?>

<?php
$userID = $_POST['userID'];
$email = $_POST['email'];
$emailCode = $_POST['emailCode'];
$newpassword = mysqli_real_escape_string($con, $_POST['newPassword']); //stops sql injection
$newpassword2 = mysqli_real_escape_string($con, $_POST['newPassword2']); //stops sql injection


$sql = "SELECT userID, salt FROM users WHERE email='$email'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con)); //Run Query
$row = mysqli_fetch_array($result); //Place results into a variable $row
$count = mysqli_num_rows($row);


if ($newpassword == $newpassword2)
{
	if (strlen($newpassword) < 8) //check if $password is 8 chars long
	{
		$_SESSION['error'] = "Password must be 8 or more characters.";
		header("location:" . $_SERVER['HTTP_REFERER']);
		exit();
	}
	else
	{
		$salt = md5(uniqid(rand(),true)); //creates a random salt
		$newpassword = hash("sha256", $newpassword.$salt); // Hashes the $password + $salt together
		$sql = "UPDATE users SET password='$newpassword', salt='$salt' WHERE userID='$userID'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con)); // runs the statement
		$sql = "DELETE FROM forgotPassword WHERE userID='$userID' AND emailCode='$emailCode'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con)); // runs the statement
		$_SESSION['success'] = "Password changed successfully!"; //Succeed message
		header("location:../pages/login.php");
		exit();
	}
}

else
{
	$_SESSION['error'] = "Your new passwords do not match";
	header("location:" . $_SERVER['HTTP_REFERER']);
	
	exit();
}
?>