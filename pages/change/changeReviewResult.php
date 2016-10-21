<?php
$pagetitle = "Review Status Change Result";

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
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/adminReviewCenter.php">Admin Review Center</a>  > Change Status </span>
        </div>
<?php

$reviewID = $_GET['reviewID'];
$reviewStatus = $_POST['accessChosen'];
$userIDConvertedToInt = intval($reviewID);

$query = "UPDATE teacherreviews SET reviewStatus='$reviewStatus' WHERE reviewID=$reviewID";

// query to change
$sql = mysqli_query($con,$query) or die(mysqli_error($con));
echo "<div class='content'>";
echo "Change Successfully Made";

echo "</div></div>";
include "../../inc/footer.php";
?>
