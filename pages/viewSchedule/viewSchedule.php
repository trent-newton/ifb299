<?php
$pagetitle = "View Schedule";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";


if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType'])) && !(isTeacher($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Students can access the Enrol Page.";
    rejectAccess();
}


$Times = array(
    0 => "9:00am-9:30am",
    1 => "9:30am-10:00am",
    2 => "10:00am-10:30am",
    3 => "10:30am-11:00am",
    4 => "11:00am-11:30am",
    5 => "11:30am-12:00pm",
    6 => "12:00pm-12:30pm",
    7 => "12:30pm-1:00pm",
    8 => "1:00pm-1:30pm",
    9 => "1:30pm-2:00pm",
    10 => "2:00pm-2:30pm",
    11 => "2:30pm-3:00pm",
    12 => "3:00pm-3:30pm",
    13 => "3:30pm-4:00pm",
    14 => "4:00pm-4:30pm",
    15 => "4:30pm-5:00pm",
);
$sqlTimes = array(
    0 => "09:00:00",
    1 => "09:30:00",
    2 => "10:00:00",
    3 => "10:30:00",
    4 => "11:00:00",
    5 => "11:30:00",
    6 => "12:00:00",
    7 => "12:30:00",
    8 => "13:00:00",
    9 => "13:30:00",
    10 => "14:00:00",
    11 => "14:30:00",
    12 => "15:00:00",
    13 => "15:30:00",
    14 => "16:00:00",
    15 => "16:30:00",
);

$Days = array(
  0 => "Monday",
  1 => "Tuesday",
  2 => "Wednesday",
  3 => "Thursday",
  4 => "Friday",
);


$timeTable = array(
    "Monday" => array(
        "09:00:00" => null,
        "09:30:00" => null,
        "10:00:00" => null,
        "10:30:00" => null,
        "11:00:00" => null,
        "11:30:00" => null,
        "12:00:00" => null,
        "12:30:00" => null,
        "13:00:00" => null,
        "13:30:00" => null,
        "14:00:00" => null,
        "14:30:00" => null,
        "15:00:00" => null,
        "15:30:00" => null,
        "16:00:00" => null,
        "16:30:00" => null
    ),
    "Tuesday" => array(
        "09:00:00" => null,
        "09:30:00" => null,
        "10:00:00" => null,
        "10:30:00" => null,
        "11:00:00" => null,
        "11:30:00" => null,
        "12:00:00" => null,
        "12:30:00" => null,
        "13:00:00" => null,
        "13:30:00" => null,
        "14:00:00" => null,
        "14:30:00" => null,
        "15:00:00" => null,
        "15:30:00" => null,
        "16:00:00" => null,
        "16:30:00" => null
    ),
    "Wednesday" => array(
        "09:00:00" => null,
        "09:30:00" => null,
        "10:00:00" => null,
        "10:30:00" => null,
        "11:00:00" => null,
        "11:30:00" => null,
        "12:00:00" => null,
        "12:30:00" => null,
        "13:00:00" => null,
        "13:30:00" => null,
        "14:00:00" => null,
        "14:30:00" => null,
        "15:00:00" => null,
        "15:30:00" => null,
        "16:00:00" => null,
        "16:30:00" => null
    ),
    "Thursday" => array(
        "09:00:00" => null,
        "09:30:00" => null,
        "10:00:00" => null,
        "10:30:00" => null,
        "11:00:00" => null,
        "11:30:00" => null,
        "12:00:00" => null,
        "12:30:00" => null,
        "13:00:00" => null,
        "13:30:00" => null,
        "14:00:00" => null,
        "14:30:00" => null,
        "15:00:00" => null,
        "15:30:00" => null,
        "16:00:00" => null,
        "16:30:00" => null
    ),
    "Friday" => array(
    "09:00:00" => null,
        "09:30:00" => null,
        "10:00:00" => null,
        "10:30:00" => null,
        "11:00:00" => null,
        "11:30:00" => null,
        "12:00:00" => null,
        "12:30:00" => null,
        "13:00:00" => null,
        "13:30:00" => null,
        "14:00:00" => null,
        "14:30:00" => null,
        "15:00:00" => null,
        "15:30:00" => null,
        "16:00:00" => null,
        "16:30:00" => null
    ));
$color = array(
    '#9b59b6',
    '#3498db',
    '#f1c40f',
    '#e67e22',
    '#95a5a6',
    '#bdc3c7',
    '#c0392b'
    );
if($_SESSION['accountType'] == "Student") {
   $sql = "SELECT * FROM users INNER JOIN contracts ON userID=studentID INNER JOIN instrumentNames ON instrumentNames.instrumentTypeID=contracts.instrumentTypeID WHERE userID='$userID' ORDER BY time, startDate";
} elseif($_SESSION['accountType'] == "Teacher") {
    $sql = "SELECT * FROM users INNER JOIN contracts ON userID=teacherID INNER JOIN instrumentNames ON instrumentNames.instrumentTypeID=contracts.instrumentTypeID WHERE userID='$userID' ORDER BY time, startDate";
    }
else {
    $sql = "SELECT * FROM users INNER JOIN contracts ON userID=teacherID INNER JOIN instrumentNames ON instrumentNames.instrumentTypeID=contracts.instrumentTypeID WHERE userID='$userID' UNION SELECT * FROM users INNER JOIN contracts ON userID=studentID INNER JOIN instrumentNames ON instrumentNames.instrumentTypeID=contracts.instrumentTypeID WHERE userID='$userID' ORDER BY time, startDate";
}
$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($result)) {
    $time = $row['time'];
    $day = $row['day'];
    $length = $row['length'];
    $instrument = $row['instrumentName'];
    //$tableColor = $color[$n];
    $timeTable[$day][$time] = "$length Minutes <br /> $instrument <br /> ";
    if($length == '60') {
        $time = strtotime("+30 minutes", strtotime($time));
        $time = date('H:i:s', $time);
        $timeTable[$day][$time] = "Continuing Lesson.";
    }

}


//var_dump($timeTable);



echo $timeTable["Friday"]["10:00:00"];

?>
    <div class="content">
        <h1>View Schedule</h1>
        <table class="scheduleTable">
            <tr>
                <th></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
            <?php
            $n = 0;
    for($row=0; $row < sizeof($Times); $row++) {
    //Left Times Column
    echo "<tr><td>" . $Times[$row] . "</td>";

    for($col=0; $col < sizeof($Days); $col++) {
        echo "<td name='$Days[$col] $sqlTimes[$row]'";

      if($timeTable[$Days[$col]][$sqlTimes[$row]] != null) {
          if($timeTable[$Days[$col]][$sqlTimes[$row]] == "Continuing Lesson."){
              echo " style='border-top: 0px; background:" . $color[$n-1] . "'>";
          } else {
              echo " style='border-bottom: 0px; background:$color[$n]'>";
              echo $timeTable[$Days[$col]][$sqlTimes[$row]];
          }


        } //end if





      echo "</td>";
    }//end col for
        if ($n > 6) {
            $n = 0;
        } else {
            $n++;
        }

    echo "</tr>";
} //End row for


?>
        </table>
    </div>
    <?php
    include "../../inc/footer.php";
    ?>
