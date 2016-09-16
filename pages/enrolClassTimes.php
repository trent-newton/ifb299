<?php

$pagetitle = "Enrol";
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



echo "<div class='content'>";
$chosenInstrument = $_POST['chosenInstrument'];
$chosenLanguage = $_POST['chosenLanguage'];
$chosenStartTime = $_POST['chosenStartTime'];
$chosenDay = $_POST['chosenDay'];

$getEndTime = floatval($chosenStartTime) + 1;
$endTime = "$getEndTime:00";

$columnTeacherDetails  = array(
    'teacherID' => 'teacherID',
    'Day' => 'day',
    'Start Time' => 'startTime',
    'End Time' => 'endTime'
);


$sql="SELECT time FROM contracts
    WHERE day = '$chosenDay' AND time = '$chosenStartTime' AND studentID = $userID";

if ($result2=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result2);
      if($rowcount > 0){
        if($accessLevel == 'admin')
        {
          echo "<h1> time slot taken click <a href='enrol.php?userID=".$userID."'> here </a> to pick another time</h1><br>";
        } else {
          echo "<h1> time slot taken click <a href='enrol.php'> here </a> to pick another time</h1><br>";
        }

          mysqli_free_result($result2);

      } else {
            $query ="SELECT DISTINCT availability.teacherID, availability.teacherID, availability.day, availability.startTime, availability.endTime
                    FROM availability INNER JOIN languages
                    WHERE availability.teacherID = languages.userID
                    AND languages.language = '$chosenLanguage'
                    AND availability.startTime <= '$chosenStartTime'
                    AND availability.endTime >= '$endTime'
                    AND availability.day = '$chosenDay'";
            $result = mysqli_query($con, $query);

            $rowcount=mysqli_num_rows($result);
            //classes available
            if ($rowcount > 0){
                echo "<h1> Here are all the times for $chosenInstrument classes in on $chosenDay from $chosenStartTime</h1>";
                //start table
                echo "<table><tr>";
                //table headings
                foreach ($columnTeacherDetails as $name => $col_name) {
                  echo "<th>$name</th>";
                }
                echo "<th>Select Class</th>";
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    foreach ($columnTeacherDetails as $name => $col_name) {
                        echo "<td> $row[$col_name] </td>";
                        $teacherID = $row['teacherID'];
                    }

                    if($accessLevel == 'admin')
                    {
                      echo "<td><a href='enrolClassDates.php?userID=".$userID."&day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";
                    } else {
                      echo "<td><a href='enrolClassDates.php?day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";
                    }
                    echo "><span class='changeAccess'> Select Class </span> </td>";
                }
                // Close table
                echo "</table><br>";
            } else {
              if($accessLevel == 'admin')
              {
                echo "<h1>No classes for this time. Click <a href='enrol.php?userID=".$userID."'> here </a> to pick another time </h1>";
              } else {
                echo "<h1>No classes for this time. Click <a href='enrol.php'> here </a> to pick another time </h1>";
              }

            }

    } //close big else statement
}
echo "</div>";
include "../inc/footer.php";
?>
