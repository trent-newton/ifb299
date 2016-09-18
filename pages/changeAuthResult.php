<?php
$pagetitle = "Change Authorisation";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
echo "<div class='content'>";
$userID = $_GET['userID'];
$changeAccess = $_POST['accessChosen'];
//$userIDConvertedToInt = intval($userID);

$query = "UPDATE users SET accountType='$changeAccess' WHERE UserID=$userID";

// query to change
$sql = mysqli_query($con,$query) or die(mysqli_error($con));
$query = "SELECT userID, firstName, lastName FROM users WHERE userID='$userID'";
$sql = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_array($sql);

echo "<h3>" .$row['firstName'] . " " . $row['lastName'] . " changed to a " . $changeAccess . "</h3>";
echo "<p><a href='../pages/changeauth.php'>Back to Users</a></p>";

echo "</div>";
include "../inc/footer.php";
?>
