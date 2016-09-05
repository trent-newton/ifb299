<?php
$pagetitle = "View Schedule";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

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

$numDays = 5;

?>
<h1>View Schedule</h1>
<div class="content">
<table class="scheduleTable">
<tr> <th></th> <th>Monday</th> <th>Tuesday</th> <th>Wednesday</th> <th>Thursday</th> <th>Friday</th> </tr>
<?php
    for($i=0; $i<sizeof($Times); $i++)
  {

    //Left Times Column
    echo "<tr><td>" . $Times[$i] . "</td>";



    for($k=0; $k < $numDays; $k++)
    {
      //simpler but code still quite a few pulls to the db. Would removing AND Day and moving the sql segment to above this for loop help with this?
      $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' AND time='$sqlTimes[$i]' AND day='$Days[$k]' ORDER BY startDate";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      echo "<td>";
      if($row['day'] == $Days[$k] && $row['time'] == $sqlTimes[$i]){
          echo $row['length'] . " Minutes";
          echo "<br />";
          echo $row['instrument'];
      }
      echo "</td>";
    }
    echo "</tr>";

    /*
    //Monday
    echo "<td>";
    $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' AND time='$sqlTimes[$i]' AND day='Monday' ORDER BY startDate";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if($row['day'] == "Monday" && $row['time'] == $sqlTimes[$i]){
        echo $row['length'] . " Minutes";
        echo "<br />";
        echo $row['instrument'];
    }
    echo "</td> ";
    //Tuesday
        $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' AND time='$sqlTimes[$i]' AND day='Tuesday' ORDER BY startDate";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    echo "<td>";
      if($row['day'] == "Tuesday" && $row['time'] == $sqlTimes[$i]){
        echo $row['length'] . " Minutes";
        echo "<br />";
        echo $row['instrument'];
      }
    echo "</td>";
    //Wednesday
        $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' AND time='$sqlTimes[$i]' AND day='Wednesday' ORDER BY startDate";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    echo "<td>";
    if($row['day'] == "Wednesday" && $row['time'] == $sqlTimes[$i]){
        echo $row['length'] . " Minutes";
        echo "<br />";
        echo $row['instrument'];
      }
    echo "</td>";
    //Thursday
        $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' AND time='$sqlTimes[$i]' AND day='Thursday' ORDER BY startDate";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    echo "<td>";
        if($row['day'] == "Thursday" && $row['time'] == $sqlTimes[$i]){
        echo $row['length'] . " Minutes";
        echo "<br />";
        echo $row['instrument'];
      }
    echo "</td>";
    //friday
        $sql = "SELECT * FROM contracts INNER JOIN users ON userID=teacherID WHERE userID='$userID' AND time='$sqlTimes[$i]' AND day='Friday' ORDER BY startDate";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    echo "<td>";
    if($row['day'] == "Friday" && $row['time'] == $sqlTimes[$i]){
        echo $row['length'] . " Minutes";
        echo "<br />";
        echo $row['instrument'];
      }
    echo "</td></tr>";
*/

  }


?>
<!--<tr> <th>9:00am-9:30am</th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>
<tr> <th>9:00am-9:30am</th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>-->
</table>

</div>



<?php include "../inc/footer.php"; ?>
