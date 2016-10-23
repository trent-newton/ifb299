<?php

session_start();
    require "../../inc/authCheck.php";

    if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Administrators can download Teacher Applications.";
        rejectAccess();
    }
if(isset($_GET['fileName']))
{
  $download_folder = '../../../applicationUploads';
  $file = $_GET['fileName'];
  $filepath = $download_folder."/".$file;


  header("Content-Type: application/pdf");
  header("Content-Disposition: attachment; filename='resume.pdf'");
  session_write_close();
  readfile($filepath);
} else {
  header("location:adminReviewApplications.php");
}
?>
