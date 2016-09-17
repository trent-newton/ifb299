<?php
$pagetitle = "User Centre";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
require "../inc/AuthCheck.php";

if(!isStudent($_SESSION['accountType']) && !isStudentTeacher($_SESSION['accountType']) && !isTeacher($_SESSION['accountType'])){
    rejectAccess();
}
?>

<div class="content adminCenter">
    <h1>Welcome to the User Centre</h1> <h3>What would you like to do?</h3>

    <div class="temp">
        <a href="../pages/myaccount.php"><div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/users.png">
           <br><h2>MY PROFILE</h2>
        </div></a>

        <a href="../pages/viewSchedule.php"><div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/calendar.png">
           <br><h2>VIEW SCHEDULE</h2>
        </div></a>

        <?php
          if(isStudent($_SESSION['accountType']) || isStudentTeacher($_SESSION['accountType'])) {
            echo '<br />';

            echo '<a href="#"><div class="temp"><img class="AdminCenterImage" src="../images/home-page-images/acoustic-guitar.png">
                  <br><h2>INSTRUMENT HIRE</h2></div></a>';

            echo '<a href="../pages/enrolPage.php"><div class="temp"><img class="AdminCenterImage" src="../images/admin-icons/settings.png">
                  <br><h2>CLASS ENROLMENT</h2></div></a>';
          }
        ?>
    </div>
</div>

<?php 
include "../inc/footer.php"; 
?>
