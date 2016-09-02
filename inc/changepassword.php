<?php
session_start();
include "../inc/connect.php";
?>
    <?php

$userID=$_POST['userID'];
$oldPassword = mysqli_real_escape_string($con,$_POST['oldPassword']);
$newPassword = mysqli_real_escape_string($con, $_POST['newPassword']);
$newPassword2 = mysqli_real_escape_string($con, $_POST['newPassword2']);
$password = $oldPassword;

$sql = "SELECT email, salt FROM users WHERE userID='$userID'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$salt = $row['salt'];
$oldPassword = hash('sha256',$password.$salt);

$sql = "SELECT email, salt, password FROM users WHERE userID='$userID' and password='$oldPassword'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

if (($oldPassword == $row['password']) && ($newPassword == $newPassword2) && ($newPassword != $password)) {
    if(strlen($newPassword) < 8) {
        $_SESSION['error'] = "Password must be 8 or more characters";
        header("location:../pages/myaccount.php");
        exit();
    } else {
        $salt = md5(uniqid(rand(),true)); //creates a random salt
        $newPassword = hash("sha256", $newPassword.$salt); // Hashes the $password + $salt together
        $sql = "UPDATE users SET password='$newPassword', salt='$salt' WHERE userID='$userID'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con)); // runs the statement
    }
    if($result) {
        $_SESSION['success'] = "Password changed successfully!"; //Succeed message
        header("location:../pages/myaccount.php");
		exit();
    }
    else
    {
        $_SESSION['error'] = "Password was not updated."; //error message
        header("location:../pages/myaccount.php");
		exit();
    }
} elseif ($oldPassword != $row['password']) 
{
    $_SESSION['error'] = "Please enter your correct password";
    header("location:../pages/myaccount.php");
    exit();
}
elseif ($newPassword != $newPassword2) {
    $_SESSION['error'] = "Your new passwords do not match";
    header("location:../pages/myaccount.php");
    exit();
}
elseif ($newPassword == $password) {
    $_SESSION['error'] = "Please enter a different password!";
    header("location:../pages/myaccount.php");
    exit();
}