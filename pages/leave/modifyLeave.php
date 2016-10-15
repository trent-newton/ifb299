<?php
session_start();
include "../../inc/connect.php";

$leaveID = $_GET['leaveID'];
$approved = $_GET['approved'];

$sql = "UPDATE leaverequests SET status='$approved' WHERE leaveID='$leaveID'";
$result = mysqli_query($con,$sql);

if($result) {
        $_SESSION['success'] = "Leave Request Updated.";
        header("location:" . $_SERVER['HTTP_REFERER']);
    }
else {
    $_SESSION['error'] = "An Error occured.";
    header("location:" . $_SERVER['HTTP_REFERER']);

}
