<?php
$pagetitle = "User Centre";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if(!isStudent($_SESSION['accountType']) && !isStudentTeacher($_SESSION['accountType']) &&                 !isTeacher($_SESSION['accountType'])){
    rejectAccess();
}
?>

<div class="content adminCenter">
    <h1>Welcome to the User Centre</h1> <h3>What would you like to do?</h3>

    <div class="temp">
        <a href="../myaccount/myaccount.php"><div class="temp"><img class="AdminCenterImage" src="../../images/admin-icons/users.png">
           <br><h2>PROFILE</h2>
        </div></a>

        <a href="../viewSchedule/viewSchedule.php"><div class="temp"><img class="AdminCenterImage" src="../../images/admin-icons/calendar.png">
           <br><h2>SCHEDULE</h2>
        </div></a>

        <?php
          if(isStudent($_SESSION['accountType']) || isStudentTeacher($_SESSION['accountType'])) {
            echo '<br />';

            echo '<a href="../../pages/instrumentHire/instrumentHire.php"><div class="temp"><img class="AdminCenterImage" src="../../images/home-page-images/acoustic-guitar.png">
                  <br><h2>HIRE</h2></div></a>';

            echo '<a href="../../pages/enrol/enrolPage.php"><div class="temp"><img class="AdminCenterImage" src="../../images/admin-icons/enrol.png">
                  <br><h2>ENROL</h2></div></a>';

            echo '<br />';

            echo '<a href="../teacherReview/reviewLessons.php"><div class="temp"><img class="AdminCenterImage" src="../../images/admin-icons/reviews.png">
               <br><h2>REVIEWS</h2>
            </div></a>';
          }
        ?>
    </div>
</div>

<?php
include "../../inc/footer.php";
?>
