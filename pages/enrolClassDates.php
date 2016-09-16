<?php
$pagetitle = "enrol";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/authCheck.php";


$accessLevel='';
$userID='';
if((isAdmin($_SESSION['accountType'])) || (isOwner($_SESSION['accountType'])))
{
    $accessLevel = 'admin';
    $sql = "SELECT firstName ,lastName FROM users WHERE userID=$userID";
}else if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Students can access the Enrol Page.";
    rejectAccess();
}
//for admins to add schedules for other users
if($accessLevel == 'admin')
{
  $userID = $_GET['userID'];
  $result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
  $name = mysqli_fetch_array($result);
  echo "<h1> Add class for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
} else {
  $userID = $_SESSION['userID'];
}

// get sent through data
$day = $_GET['day'];
$startTime = $_GET['startTime'];
$instrument = $_GET['instrument'];
$teacherID = $_GET['teacherID'];
$studentID = $userID;

?>

<div class="content enrolPage">
    <?php
    if($accessLevel == 'admin')
    {
      echo '<form action="../pages/enrolClassTimeProcess.php?userID='.$userID.'" method="post">';
    } else {
      echo '<form action="../pages/enrolClassTimeProcess.php" method="post">';
    }

     ?>

    <form action="../pages/enrolClassTimeProcess.php" method="post">
    <h2>Please Select a Start Date and End Date for the Lesson</h2>
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
