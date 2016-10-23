<?php
$pagetitle = "Admin Center";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>

<div class="content centered">
    <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > Admin Center</span>
        </div>
    <h1>Welcome to the Admin Center</h1> <h3>What would you like to manage?</h3>

    <div class="common">
        <a href="../change/changeAuth.php"><div class="common"><img class="AdminCenterImage" src="../../images/admin-icons/users.png">
            <br><h2>USERS</h2>
        </div></a>

        <a href="../../pages/admin/instrumentsAdmin.php"><div class="common"><img class="AdminCenterImage" src="../../images/home-page-images/acoustic-guitar.png">
           <br><h2>INSTRUMENTS</h2>
        </div></a>

        <br>

        <a href="../admin/adminReviewCenter.php"><div class="common"><img class="AdminCenterImage" src="../../images/admin-icons/reviews.png">
           <br><h2>REVIEWS</h2>
        </div></a>

        <a href="../myaccount/myaccount.php"><div class="common"><img class="AdminCenterImage" src="../../images/admin-icons/user.png">
           <br><h2>MY PROFILE</h2>
        </div></a>

        <br>

        <a href="../leave/reviewLeaveRequests.php"><div class="common"><img class="AdminCenterImage" src="../../images/admin-icons/leave.png">
           <br><h2>LEAVE REQUESTS</h2>
        </div></a>

        <a href="../admin/adminReviewApplications.php"><div class="common"><img class="AdminCenterImage" src="../../images/admin-icons/enrol.png">
           <br><h2>JOB APPLICATIONS</h2>
        </div></a>
    </div>
</div>

<?php include "../../inc/footer.php"; ?>
