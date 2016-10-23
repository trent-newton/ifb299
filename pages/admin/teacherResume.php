<?php

session_start();
include "../../inc/connect.php";
    require "../../inc/authCheck.php";

    if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Administrators can download Teacher Applications.";
        rejectAccess();
    }
if(isset($_GET['fileName']))
{
  $appID = $_GET['userID'];
    $sql = "SELECT firstName, lastName FROM users WHERE userID='$appID'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    
  $download_folder = '../../../applicationUploads';
  $file = $_GET['fileName'];
  $filepath = $download_folder."/".$file;
    $name = $row['firstName'] . "_" . $row['lastName'] . "_resume.pdf";
    echo $name;
  header("Content-Type: application/pdf");
  header("Content-Disposition: attachment; filename=" . $name);
  session_write_close();
  readfile($filepath);
} else {
  header("location:adminReviewApplications.php");
}
?>
