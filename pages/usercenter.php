<?php
$pagetitle = "Student Center";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
?>

<div class="content adminCenter">
    <h1>Welcome to the User Center</h1> <h3>What would you like to do?</h3>

    <div class="temp">
        <div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/calendar.png">
           <br><button class="AdminCenterButton"><a formaction="../pages/viewschedule.php" class="button">View Schedule</a></button>
        </div>

        <div class="temp"><img class="AdminCenterImage" src="../images/home-page-images/acoustic-guitar.png">
           <br><button class="AdminCenterButton"><a href="" class="button">Instrument Hire</a></button>
        </div><br>

        <div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/users.png">
           <br><button class="AdminCenterButton"><a href="" class="button">Update Details</a></button>
        </div>

        <div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/settings.png">
           <br><button class="AdminCenterButton"><a href="" class="button">Setting</a></button>
        </div>
    </div>
</div>

<?php include "../inc/footer.php"; ?>
