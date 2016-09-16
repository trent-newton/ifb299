<?php

$pagetitle = "Enrol";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/authCheck.php";

echo "<div class='content'>";

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
  'instrument' => 'instrument'
);

$columnLanguage  = array(
  'language' => 'language'
);


//query to find list of instruments
$resultInstrument = mysqli_query($con,"SELECT distinct instrument FROM instruments");

//query to find list of langauges
$resultLanguage = mysqli_query($con,"SELECT distinct language FROM languages");

//select instrument
echo '<br> Select an instrument';
if($accessLevel == 'admin')
{
  echo '<form method="post" action="enrolClassTimes.php?userID='.$userID.'">';
} else {
  echo '<form method="post" action="enrolClassTimes.php">';
}
    echo '<select required name="chosenInstrument">
      <option value="" disabled selected> Select... </option>';

      while($row = mysqli_fetch_array($resultInstrument)) {
          foreach ($columnInstrument as $name => $col_name) {
            echo "<option value='$row[$col_name]'>$row[$col_name]</option>";
          }
      }
    echo '</select><br> Select language <br> ';

    //select language
    echo '<select required name="chosenLanguage">
      <option value="English" selected="selected"> English </option>';
        while($row = mysqli_fetch_array($resultLanguage)) {
          foreach ($columnLanguage as $name => $col_name) {
            echo "<option value='$row[$col_name]'>$row[$col_name]</option>";
          }
      }
    echo '</select><br> Select a day<br>';

    // select day ?>
    <select required name="chosenDay">
        <option value="" >Select day </option>
        <option value="Monday" > Monday</option>
        <option value="Tuesday" > Tuesday</option>
        <option value="Wednesday" > Wednesday</option>
        <option value="Thursday" > Thursday</option>
        <option value="Friday" > Friday</option>
    </select>

    <!-- select start time -->
    <br>Select start time (please enter in 24 hour time like 13:00) <br>
    <input type="text" name="chosenStartTime" pattern="[0-9][0-9]:00|30" title="please enter in 24 hour time">

    <input type="submit" name="submit" value="Select Class Times">
</form>
</div>
<?php include "../inc/footer.php"; ?>
