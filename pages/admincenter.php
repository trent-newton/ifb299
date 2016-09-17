<?php
$pagetitle = "Admin Center";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>

<div class="adminCenter">
    <h1>Welcome to the Admin Center</h1> <h3>What would you like to do?</h3>
    
    <div class="temp">
        <a href="../pages/changeAuth.php"><div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/users.png">
            <br><h2>USER MANAGEMENT</h2>
        </div></a>

        <a href="#"><div class="temp"><img class="AdminCenterImage" src="../images/home-page-images/acoustic-guitar.png">
           <br><h2>INSTRUMENT MANAGEMENT</h2>
        </div></a>
            
        <a href="../pages/myaccount.php"><div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/users.png">
           <br><h2>MY PROFILE</h2>
        </div></a>

        <!--<a href="#"><div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/settings.png">
           <br><button class="AdminCenterButton"><a href="" class="button">Setting</a></button>
        </div>-->
    </div>
</div>

<?php include "../inc/footer.php"; ?>
