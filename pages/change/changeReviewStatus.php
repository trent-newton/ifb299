<?php
$pagetitle = "Change Review Status";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
?>
<div class='content'>
<div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/adminReviewCenter.php">Admin Review Center</a> > Change Review Status</span>
        </div>
    
<?php
// Get selected userID
$reviewID = $_GET['reviewID'];

// Run the query & fetch results
$sql = "SELECT teacherreviews.*,users.firstName AS studFN, users.lastName AS studLN, stuff.firstName AS teachFN, stuff.lastName AS teachLN FROM users INNER JOIN teacherreviews ON userID=studentID INNER JOIN users AS stuff ON stuff.userID= teacherreviews.teacherID WHERE reviewID = $reviewID";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
echo "<div class='loginForm center-horizontal'>";
// Print header
echo "<h2> Change review for ".$row['teachFN']." ".$row['teachLN']." (Review ID $reviewID) </h2>";
// Simple form with account types
echo'<br> Change review status to:
<form method="post" action="changeReviewResult.php?reviewID='. $reviewID . '">
    <select class="form-control" required name="accessChosen">
      <option value="" disabled selected> Select... </option>
      <option value="Public">Public</option>
      <option value="Private">Private</option>
      <option value="Invalid">Invalid</option>
      </select>
    <input class="form-control" type="submit" value="Changes">
</form>';

echo "</div>";

include "../../inc/footer.php";
?>
