<?php

session_start();
include "../../inc/connect.php";


$email = mysqli_real_escape_string($con, $_POST['email']);


$sql = "SELECT userID FROM users WHERE email='$email'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$numrow = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$userID = $row['userID'];

if($numrow == 1) {
    $emailCode = md5(uniqid(rand(), true));
    $link = "http://localhost/MusicSchool/pages/resetpassword.php?email=$email&emailCode=$emailCode";
    $sql = "INSERT INTO forgotPassword (userID, emailCode, link) VALUES ('$userID', '$emailCode', '$link')";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    if($result) {
        $to = $email;
        $subject = "Reset your password at Pinelands Music School";
        $message = "Please click the link below to reset the password. \r\n\n ";
        $message .= "If you did not request a password reset, please ignore this email. Otherwise click below... \r\n";
        $message .= "http://www.pinelands-MS.com/pages/resetpassword.php?email=$email&emailCode=$emailCode";
        
        
        mail("$email", "Subject: $subject", $message);
        $_SESSION['success'] = "Password Reset sent. Please check your email.";
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    $_SESSION['error'] = "That email is not in our database";
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit();

}
               