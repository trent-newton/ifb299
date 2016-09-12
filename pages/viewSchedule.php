<?php
$pagetitle = "View Schedule";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/authCheck.php";

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
if($_SESSION['accountType'] == "Student") {
   $sql = "SELECT * FROM contracts INNER JOIN users ON userID=studentID WHERE userID='$userID' ORDER BY time, startDate";
} elseif($_SESSION['accountType'] == "Teacher") {
    $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' ORDER BY time, startDate";
    }
else {
    $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' UNION SELECT * FROM contracts INNER JOIN users ON userID=studentID WHERE userID='$userID' ORDER BY time, startDate";
}
$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($result)) {
    $contractID = $row['contractID'];
    $time = $row['time'];
    $day = $row['day'];
    $length = $row['length'];
    $instrument = $row['instrument'];

    $timeTable[$day][$time] .= "$length Minutes <br /> $instrument <br />$contractID|";
    if($length == '60') {
        $time = strtotime("+30 minutes", strtotime($time));
        $time = date('H:i:s', $time);
        $timeTable[$day][$time] .= "$length Minutes <br /> $instrument <br />$contractID|";
        //echo $time . "<br />";
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
    for($i=0; $i<sizeof($Times); $i++)
  {

    //Left Times Column
    echo "<tr><td>" . $Times[$i] . "</td>";



    for($k=0; $k < sizeof($Days); $k++)
    {


      if($timeTable[$Days[$k]][$sqlTimes[$i]] != null){
        //if class then colour cell and change border val
        echo "<td name='$Days[$k] $sqlTimes[$i]' style='background-color:#cd8cdd;border:0px'>";
        //if class is hour long, and the cell before it is also the same hour long class
        //this might cause problems if a person has 2 hour long classes of the same instrument back to back.
        if(($i>0) && (substr($timeTable[$Days[$k]][$sqlTimes[$i]], 0, 2) == '60') && ($timeTable[$Days[$k]][$sqlTimes[$i]]==$timeTable[$Days[$k]][$sqlTimes[$i-1]]))
        {
          //do nothing. no need to fill table again.
        } else {
          //files table like normal
          //temp exists so that nothing in the array actually gets replaced
          $temp = $timeTable[$Days[$k]][$sqlTimes[$i]];
          echo preg_replace("/[0-9]+\|+/", "", $temp);
          //echo $timeTable[$Days[$k]][$sqlTimes[$i]];
        }
      } else {
        echo "<td name='$Days[$k] $sqlTimes[$i]'>";
      }

      echo "</td>";
    }
    echo "</tr>";


  }
?>
        </table>
    </div>

    <?php
    include "../inc/footer.php";
    ?>
