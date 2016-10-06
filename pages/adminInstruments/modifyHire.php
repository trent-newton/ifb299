<?php
session_start();
include "../../inc/connect.php";

$instrumentHireID = $_GET['instrumentHireID'];
$approved = $_GET['approved'];

$sql = "UPDATE instrumentHire SET adminApproved='$approved' WHERE instrumentHireID='$instrumentHireID'";
$result = mysqli_query($con,$sql);

if($result) {
        $_SESSION['success'] = "Student Hire Updated.";
        header("location:" . $_SERVER['HTTP_REFERER']);
    }
else {
    $_SESSION['error'] = "An Error occured.";
    header("location:" . $_SERVER['HTTP_REFERER']);
   
}