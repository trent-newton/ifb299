<?php
session_start();
include "../inc/connect.php";

//Prevents SQL Injection
$password = mysqli_real_escape_string($con, $_POST['password']);
$email = mysqli_real_escape_string($con, $_POST['email']);


//sets the query and runs it.
$sql = "SELECT email, salt FROM users WHERE email='$email'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

//Places the results into the variable $row
$row = mysqli_fetch_array($result);

//Grabs the salt
$salt = $row['salt'];

//Puts the password and salt together and hashes them using sha256
$password = hash('sha256', $password.$salt);

$sql = "SELECT userID, email, password, accountType, firstName, lastName, comCode FROM users WHERE email='$email' and password='$password'";

$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

if($count == 1) {
    if(is_null($row['comCode'])) {
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['accountType'] = $row['accountType'];
        $_SESSION['success'] = "Welcome back " .ucfirst($row['firstName']) . " "  . ucfirst($row['lastName']);
        header("location:../pages/index.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Incorrect email or Password.<br /> Please try again.";
    header("location:../pages/index.php");
    exit();
}