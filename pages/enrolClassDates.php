<?php
$pagetitle = "enrol";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

// get sent through data
$day = $_GET['day'];
$startTime = $_GET['startTime'];
$instrument = $_GET['instrument'];
$teacherID = $_GET['teacherID'];
$studentID = $_SESSION['userID'];

?>

<div class="content enrolPage">
    <form action="../pages/enrolClassTimeProcess.php" method="post">
    <h2>Please Select a Start Date and end date for the Lesson</h2>
        <label>Start Date</label>
        <input type="date" name="startDate" required />
        <label>End Date</label>
        <input type="date" name="endDate" required />
        <input type="hidden" name="day" value="<?php echo $day?>" />
        <input type="hidden" name="startTime" value="<?php echo $startTime?>" />
        <input type="hidden" name="instrument" value="<?php echo $instrument?>" />
        <input type="hidden" name="teacherID" value="<?php echo $teacherID?>" />
        <input type="hidden" name="studentID" value="<?php echo $studentID?>" />
        <input type="submit" name="submit" value="submit" />
    </form>


</div><!--end content-->

<?php

include "../inc/footer.php";
?>