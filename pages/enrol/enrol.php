<?php

$pagetitle = "Enrol";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

echo "<div class='form-content'>";

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
}

$columnInstrument  = array(
  'instrumentName' => 'instrumentName'
);

$columnLanguage  = array(
  'language' => 'language'
);


//query to find list of instruments
$resultInstrument = mysqli_query($con,"SELECT distinct instrumentName FROM instrumentNames");

//query to find list of langauges
$resultLanguage = mysqli_query($con,"SELECT distinct language FROM languages");

if($accessLevel == 'admin')
{
  echo '<br><form method="post" class="form-inline" action="enrolClassTimes.php?userID='.$userID.'">';
} else {
  echo '<br><form method="post" class="form-inline" action="enrolClassTimes.php">';
}
echo '<div class="row">';
  echo '<div class="col-md-2">';
    //select instrument
    echo '<select class="form-control" required name="chosenInstrument">
      <option value="" disabled selected> Select Instrument </option>';

      while($row = mysqli_fetch_array($resultInstrument)) {
          foreach ($columnInstrument as $name => $col_name) {
            echo "<option value='$row[$col_name]'>$row[$col_name]</option>";
          }
      }
    echo '</select></div>';
echo '<div class="col-md-2">';
    //select language
    echo '<select class="form-control" required name="chosenLanguage">
      <option value="" disabled selected> Select Language </option>';
        while($row = mysqli_fetch_array($resultLanguage)) {
          foreach ($columnLanguage as $name => $col_name) {
            echo "<option value='$row[$col_name]'>$row[$col_name]</option>";
          }
      }
    echo '</select></div>';

    // select day ?>
    <div class="col-md-2">
    <select class="form-control" required name="chosenDay">
        <option value="" >Select Day </option>
        <option value="Monday" > Monday</option>
        <option value="Tuesday" > Tuesday</option>
        <option value="Wednesday" > Wednesday</option>
        <option value="Thursday" > Thursday</option>
        <option value="Friday" > Friday</option>
    </select></div>

    <div class="col-md-3">
    <!-- select start time -->
    <input class="form-control" type="text" name="chosenStartTime" pattern="[0-9][0-9]:00|30" title="please enter in 24 hour time" placeholder="Start time (24 hour format)">
  </div><div class="col-md-2">
    <input class="form-control" type="submit" name="submit" value="Select Class Times">
  </div></div>
</form>
</div>



<?php include "../../inc/footer.php"; ?>
