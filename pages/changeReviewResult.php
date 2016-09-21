<?php
$pagetitle = "Review Status Change Result";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/bootstrap.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$reviewID = $_GET['reviewID'];
$reviewStatus = $_POST['accessChosen'];
$userIDConvertedToInt = intval($reviewID);

$query = "UPDATE teacherreviews SET reviewStatus='$reviewStatus' WHERE reviewID=$reviewID";

// query to change
$sql = mysqli_query($con,$query) or die(mysqli_error($con));
echo "<div class='content'>";
echo "Change Successfully Made";
echo '<br /><a href="adminReviewCenter.php" class="button"><< Return to Reviews Center</a>';

echo "</div>";
include "../inc/footer.php";
?>
