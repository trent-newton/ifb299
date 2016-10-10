<?php

$pagetitle = "Enrol";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";
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





function recommendClasses($teacherID, $chosenDay, $chosenStartTime, $teacherStart, $teacherEnd, $chosenInstrument){
  $sqlRecommended = "SELECT contracts.time, users.firstname FROM contracts INNER JOIN availability INNER JOIN users
                      WHERE contracts.teacherID = $teacherID
                      AND contracts.day = $chosenDay
                      AND contracts.time != $chosenStartTime
                      ORDER BY contracts.time ASC";

  $resultRecommended = mysqli_query($con, $sqlRecommended) or die(mysqli_error($con));
  $rowRecommended = mysqli_fetch_array($resultRecommended);

  $teacherStartTime = floatval($TeacherStart);
  $teacherEndTime = floatval($TeacherEnd);
  $str = '';
  for($i=$teacherStartTime; $i<($teacherEndTime-$teacherStartTime); $i++) {
    if($i != $rowRecommended[$i-$teacherStartTime]) {
      $str = '<tr><td>'.$chosenDay.'</td><td>'.$chosenStartTime.'</td><td>'.$teacherID.'</td>';
      if($accessLevel == 'admin')      {
        $str += "<td><a href='enrolClassDates.php?userID=".$userID."&day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";
      } else {
        $str += "<td><a href='enrolClassDates.php?day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";
      }
      $str += "><span class='changeAccess'> Select Class </span></a></td></tr>";
    }
  }

}




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

                $rowcount=mysqli_num_rows($result);

                //classes available
                if ($rowcount > 0){

                    echo "<h1>$chosenInstrument classes on $chosenDay from $chosenStartTime to $endTime </h1>";
                    //start table
                    echo "<table class='table'><tr>";
                    //table headings
                    foreach ($columnTeacherDetails as $name => $col_name) {
                      echo "<th>$name</th>";
                    }
                    echo "<th> Time </th>
                          <th> Teacher </th>
                          <th>Select Class</th>";
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
                            echo "<tr>";
                            foreach ($columnTeacherDetails as $name => $col_name) {
                                echo "<td> $row[$col_name] </td>";
                                $teacherID = $row['teacherID'];
                            }
                            echo "<td>". $chosenStartTime.'-'. $endTime ."</td>";
                            //get teacher's name
                            $sqlTeacherName = "SELECT distinct users.firstName FROM availability INNER JOIN users
                                                where availability.teacherID = users.UserID
                                                AND users.UserID = '$teacherID'";
                            $resultTeacherName = mysqli_query($con, $sqlTeacherName) or die(mysqli_error($con));
                            $rowTeacherName = mysqli_fetch_array($resultTeacherName);

                            echo "<td>". $rowTeacherName['firstName']."</td>";

                            //select class TD
                            if($accessLevel == 'admin')
                            {
                              echo "<td><a href='enrolClassDates.php?userID=".$userID."&day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";
                            } else {
                              echo "<td><a href='enrolClassDates.php?day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";
                            }
                            echo "><span class='changeAccess'> Select Class </span> </td>";
                            $teachersAvailableCount++;
                        }
                    }
                    if($teachersAvailableCount == 0)
                    {
                        echo "<h1>There are not any available classes during selected time.</h1>";
                    }
                    // Close table
                    echo "</table><br>";
                } else {
                  echo "<h1>There are not any available classes during selected time.</h1>";
                }
        } //close big else statement
    }
}
echo "</div>";
include "../../inc/footer.php";
?>
