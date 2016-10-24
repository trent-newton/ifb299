<?php
session_start();
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $formcontent="From: $firstName $lastName \n Message: $message";
    $recipient = "trent.edu@icloud.com";
    $subject = "Question From Website Contact Form";
    $mailheader = "From: $email \r\n";

    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
    $_SESSION['success'] = "Message Sent!";
    header("location: ../pages/home/index.php");
    exit();
?>
