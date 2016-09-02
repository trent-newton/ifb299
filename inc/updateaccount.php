<?php
session_start();
include "../inc/connect.php";
?>

<?php
$userID = $_POST['userID'];


$facebookID = mysqli_real_escape_string($con,$_POST['facebookID']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$parentName = mysqli_real_escape_string($con,$_POST['parentName']);
$parentEmail = mysqli_real_escape_string($con,$_POST['parentEmail']);

if($email == "") {
    $_SESSION['error'] = "All * fields are required.";
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit();
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) || ($parentEmail != "" && !filter_var($parentEmail, FILTER_VALIDATE_EMAIL))) {
    $_SESSION['error'] = "Please enter a valid email and Parent Email";
    header("location:" . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    $sql = "Update users SET email='$email', facebookId='$facebookID', parentName='$parentName', parentEmail='$parentEmail' WHERE userID='$userID'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $_SESSION['success'] = "Account Updated";
    header("location:" . $_SERVER["HTTP_REFERER"]);
    exit();
}