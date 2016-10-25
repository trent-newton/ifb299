<?php
$pagetitle = "Change Leave Status";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
// Get selected userID
$leaveID = $_GET['leaveID'];

// Run the query & fetch results
$sql = "SELECT leaverequests.*, users.firstName, users.lastName FROM leaverequests, users WHERE leaverequests.userID = users.userID";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
echo "<div class='loginForm center-horizontal'>";
// Print header
echo "<h2> Change leave for ".$row['firstName']." ".$row['lastName']." (Review ID $leaveID) </h2>";
// Simple form with account types
echo'<br> Change review status to:
<form method="post" action="changeLeaveResult.php?leaveID='. $leaveID . '">
    <select class="form-control" required name="accessChosen">
      <option value="" disabled selected> Select... </option>
      <option value="Approved">Approved</option>
      <option value="Denied">Denied</option>
      </select>
    <input class="form-control" type="submit" value="Changes">
</form>';

echo "</div>";

include "../../inc/footer.php";
?>
