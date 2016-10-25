<?php
$pagetitle = "Leave Status Change Result";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$leaveID = $_GET['leaveID'];
$status = $_POST['accessChosen'];
//$userIDConvertedToInt = intval($leaveID);

$query = "UPDATE leaverequests SET status='$status' WHERE leaveID=$leaveID";

// query to change
$sql = mysqli_query($con,$query) or die(mysqli_error($con));
echo "<div class='content'>";
echo "Change Successfully Made";
echo '<br /><a href="../leave/reviewLeaveRequests.php" class="button"><< Return to Leave Center</a>';

echo "</div>";
include "../../inc/footer.php";
?>
