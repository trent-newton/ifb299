<?php
$pagetitle = "Instrument Admin";
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
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > Instrument Admin</span>
        </div>
    <h1>Welcome to the Instrument Admin</h1> <h3>What would you like to manage?</h3>

    <div class="common">
        <a href="../adminInstruments/adminHire.php"><div class="common"><img class="AdminCenterImage" src="../../images/admin-icons/users.png">
            <br><h2>HIRE<br />REQUESTS</h2>
        </div></a>

        <a href="../adminInstruments/adminInstruments.php"><div class="common"><img class="AdminCenterImage" src="../../images/home-page-images/acoustic-guitar.png">
           <br><h2>MANAGE<br />INSTRUMENTS</h2>
        </div></a>

        <a href="../adminInstruments/addNewInstrumentType.php"><div class="common"><img class="AdminCenterImage" src="../../images/home-page-images/acoustic-guitar-plus.png">
           <br><h2>CREATE NEW<br />INSTRUMENT</h2>
        </div></a>

        <br />


    </div>
</div>

<?php include "../../inc/footer.php"; ?>
