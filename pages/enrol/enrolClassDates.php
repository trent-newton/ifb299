<?php
$pagetitle = "Enrol";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";


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

<div class="loginForm center-horizontal">
    <?php
    if($accessLevel == 'admin')
    {
      echo '<form class="basic-form" action="enrolClassTimeProcess.php?userID='.$userID.'" method="post">';
    } else {
      echo '<form class="basic-form" action="enrolClassTimeProcess.php" method="post">';
    }

     ?>
    <h2>Contract Duration</h2><h4>
        Start Date
        <input class="form-control" type="date" name="startDate" required /><br>
        End Date
        <input class="form-control" type="date" name="endDate" required />
        <input type="hidden" name="day" value="<?php echo $day?>" />
        <input type="hidden" name="startTime" value="<?php echo $startTime?>" />
        <input type="hidden" name="instrument" value="<?php echo $instrument?>" />
        <input type="hidden" name="teacherID" value="<?php echo $teacherID?>" />
        <input type="hidden" name="studentID" value="<?php echo $studentID?>" />
        <input class="form-control" type="submit" name="Submit" value="submit" />
    </form>
</div><!--end content-->

<?php

include "../../inc/footer.php";
?>
