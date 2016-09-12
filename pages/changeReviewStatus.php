<?php
$pagetitle = "Change Review Status";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
// Get selected userID
$reviewID = $_GET['reviewID'];

// Run the query & fetch results
$result = "SELECT teacherreviews.*,users.firstName AS studFN, users.lastName AS studLN, stuff.firstName AS teachFN, stuff.lastName AS teachLN FROM users INNER JOIN teacherreviews ON userID=studentID INNER JOIN users AS stuff ON stuff.userID= teacherreviews.teacherID WHERE reviewID = $reviewID";
$name = mysqli_fetch_array($result);

// Print header
echo "<h1> Change review for ".$name['firstName']." ".$name['lastName']." (Review ID $reviewID) </h1>";
// Simple form with account types
echo'<br> Change review status to:
<form method="post" action="changeReviewResult.php?reviewID='.$reviewID.'">
    <select required name="accessChosen">
      <option value="" disabled selected> Select... </option>
      <option value="Public">Public</option>
      <option value="Private">Private</option>
      <option value="Invalid">Invalid</option>
      </select>
    <input type="submit" value="Changes">
</form>';

include "../inc/footer.php";
?>
