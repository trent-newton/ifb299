<?php
$pagetitle = "change authorisation";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

$userID = $_GET['userID'];
$changeAccess = $_POST['accessChosen'];
$userIDConvertedToInt = intval($userID);

$query = "UPDATE users SET accountType='$changeAccess' WHERE UserID=$userID"; 

// query to change
$sql = mysqli_query($con,$query) or die(mysqli_error($con));   

echo "change successfully made";

include "../inc/footer.php";
?>