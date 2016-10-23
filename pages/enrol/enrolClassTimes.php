<?php

$pagetitle = "Enrol";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";
?>
<div class="content">
<div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../usercenter/usercenter.php">User Center</a> > Enrol</span>
        </div>
<?php


include "enrol.php";

$accessLevel='';
$userID='';

if((isAdmin($_SESSION['accountType'])) || (isOwner($_SESSION['accountType'])))
{
    $accessLevel = 'admin';
}else if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Students can access the Enrol Page.";
    rejectAccess();
}

//for admins to add schedules for other users
if($accessLevel == 'admin'){
  $userID = $_GET['userID'];
  $result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
  $name = mysqli_fetch_array($result);
  echo "<h1> Add class for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
} else {
  $userID = $_SESSION['userID'];
}
?>


<?php

function recommendClasses($teachersList, $chosenDay, $chosenStartTime, $chosenInstrument, $con, $accessLevel){
  $str='';
  if($teachersList[0] != null)
  {
    //classes at different times on the same day
    for($i=0; $i<count($teachersList); $i++)
    {
      $teacher =  $teachersList[$i];
      $sqlTeacherInfo = "SELECT  distinct availability.startTime, availability.endTime, users.firstname, users.lastname FROM availability
                        INNER JOIN users ON availability.teacherID = users.userID
                        INNER JOIN contracts ON contracts.teacherID=availability.teacherID
                        WHERE contracts.teacherID = '$teacher'
                        AND availability.day = '$chosenDay'";
      $resultTeacherInfo = mysqli_query($con, $sqlTeacherInfo);
      $rowTeacherInfo = mysqli_fetch_array($resultTeacherInfo);

      $sqlRecommended = "SELECT distinct contracts.time FROM contracts
                          WHERE (contracts.teacherID = '$teacher' or contracts.studentID = '$teacher')
                          AND contracts.day = '$chosenDay'
                          ORDER BY contracts.time ASC";
      $resultRecommended = mysqli_query($con, $sqlRecommended);
      $row = mysqli_fetch_array($resultRecommended);

      $teacherStartTime = floatval($rowTeacherInfo['startTime']);
      $teacherEndTime = floatval($rowTeacherInfo['endTime']);

      for($j=$teacherStartTime; $j<($teacherEndTime); $j++) {
        if($j != floatval($row['time']))
        {
          //add to string that will be returned
          $endTime = ($j+1) . ":00:00";
          $str .= ListClass($chosenDay, $j.":00:00", $endTime, $chosenInstrument, $teacher, $rowTeacherInfo['firstname'], $rowTeacherInfo['lastname'], $accessLevel);
        } else {
          //progress in result row
          $row = mysqli_fetch_array($resultRecommended);
        }
      }
      }
  }
  return $str;
}

function ListClass($Day, $StartTime, $endTime, $Instrument, $teacherID, $teacherFirstName, $teacherLastName,  $accessLevel){
      $str = '<tr><td>'.$Day.'</td><td>'.$StartTime.'-'.$endTime.'</td><td>'.$teacherFirstName.' '.$teacherLastName.'</td>';
      if($accessLevel == 'admin') {

        $str .= "<td><a href='enrolClassDates.php?userID=".$_GET['userID']."&day=$Day&startTime=$StartTime&instrument=$Instrument&teacherID=$teacherID'";
      } else {
        $str .= "<td><a href='enrolClassDates.php?day=$Day&startTime=$StartTime&instrument=$Instrument&teacherID=$teacherID'";
      }
      $str .= "><span class='changeAccess'> Select Class </span></a></td></tr>";
  return $str;
}
?>

<?php
echo "<div class='content centered'>";
//check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $chosenInstrument = $_POST['chosenInstrument'];
    $chosenLanguage = $_POST['chosenLanguage'];
    $chosenStartTime = $_POST['chosenStartTime'];
    $chosenDay = $_POST['chosenDay'];
    $getEndTime = floatval($chosenStartTime) + 1;
    $endTime = "$getEndTime:00";

    $columnTeacherDetails  = array(
        'Day' => 'day',
        'Time' => 'time',
        'Teacher' => 'teacher',
        'Select Class' => 'select_class',
    );

    //check if student already has a class at selected time
    $sql="SELECT time FROM contracts
        WHERE day = '$chosenDay' AND time = '$chosenStartTime' AND studentID = $userID";

    if ($result2=mysqli_query($con,$sql))
      {
      // Return the number of rows in result set
      $rowcount=mysqli_num_rows($result2);
          if($rowcount > 0){
            if($accessLevel == 'admin')
            {
              echo "<h1> This student already had a class during this time.";
            } else {
              echo "<h1> You already have a class during this time.</h1><br>";
            }

              mysqli_free_result($result2);

          } else {
                $query ="SELECT DISTINCT availability.teacherID, availability.day,  availability.startTime, availability.endTime
                        FROM availability INNER JOIN languages INNER JOIN userinstrument INNER JOIN instrumentnames
                        WHERE availability.teacherID = languages.userID
                        AND languages.language = '$chosenLanguage'
                        AND availability.startTime <= '$chosenStartTime'
                        AND availability.endTime >= '$endTime'
                        AND availability.day = '$chosenDay'
                        AND instrumentnames.instrumentName = '$chosenInstrument'";

                $result = mysqli_query($con, $query);

                $rowcount = mysqli_num_rows($result);

                //list to be used for recommendations
                $teachersList = [];
                //classes available
                if ($rowcount > 0){

                    echo "<h1>$chosenInstrument classes on $chosenDay from $chosenStartTime to $endTime </h1>";
                    //start table
                    echo "<table class='table'><tr>";
                    //table headings
                    foreach ($columnTeacherDetails as $name => $col_name) {
                      echo "<th>$name</th>";
                    }

                    $teachersAvailableCount = 0;
                    while($row = mysqli_fetch_array($result)){
                        $teacherID = $row['teacherID'];
                        //check if teacher is already booked in time slot
                        $sqlCheckIfTeacherBooked = "SELECT * FROM Contracts
                                            WHERE time = '$chosenStartTime'
                                            AND day = '$chosenDay'
                                            and teacherID = '$teacherID'";

                        $resultCheckIfTeacherBooked = mysqli_query($con, $sqlCheckIfTeacherBooked) or die(mysqli_error($con));

                        if (mysqli_num_rows($resultCheckIfTeacherBooked) == 0){
                            $teacherID = $row['teacherID'];
                            //get teacher's name
                            $sqlTeacherName = "SELECT distinct users.firstName, users.lastName FROM availability INNER JOIN users
                                                where availability.teacherID = users.UserID
                                                AND users.UserID = '$teacherID'";
                            $resultTeacherName = mysqli_query($con, $sqlTeacherName) or die(mysqli_error($con));
                            $rowTeacherName = mysqli_fetch_array($resultTeacherName);

                             echo ListClass($chosenDay, $chosenStartTime, $endTime, $chosenInstrument, $teacherID, $rowTeacherName['firstName'], $rowTeacherName['lastName'], $accessLevel);
                            $teachersAvailableCount++;
                        } else {
                          $teachersList[] = $teacherID;
                        }
                    }
                    if($teachersAvailableCount == 0)
                    {
                        $strClasses = recommendClasses($teachersList, $chosenDay, $chosenStartTime, $chosenInstrument, $con, $accessLevel);
                        if ($strClasses == '')
                        {
                          echo "<h2>There are no available classes during selected time or day for your instrument.</h2>";
                        } else {
                          echo "<h2>There are no available classes during selected time. Here some classes for the $chosenInstrument on $chosenDay.</h2>";
                          echo $strClasses;
                        }
                    }
                    // Close table
                    echo "</table><br>";
                } else {
                  echo "<h1>There are not any available classes during selected time.</h1>";
                }
        } //close big else statement
    }
} else
{
  echo "<br><br><br><br>";
}
echo "</div>";
    echo "</div>";
include "../../inc/footer.php";
?>
