<?php
$pagetitle = "Student Center";
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
    10 => "2:30pm-3:00pm",
    11 => "3:00pm-3:30pm",
    12 => "3:30pm-4:00pm",
    12 => "4:00pm-4:30pm",
    13 => "4:30pm-5:00pm",
);

$Days = array(
  0 => "Monday",
  1 => "Tuesday",
  2 => "Wednesday",
  3 => "Thursday",
  4 => "Friday",
);

?>
<h1>View Schedule</h1>

<table style="width=100;">
<tr> <th></th> <th>Monday</th> <th>Tuesday</th> <th>Wednesday</th> <th>Thursday</th> <th>Friday</th> </tr>
<?php
  for($i=0; $i<sizeof($Times); $i++)
  {
    echo "<tr><td>" . $Times[$i] . "</td><td></td> <td></td> <td></td> <td></td> <td></td></tr>";


  }


?>
<!--<tr> <th>9:00am-9:30am</th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>
<tr> <th>9:00am-9:30am</th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>-->
</table>





<?php include "../inc/footer.php"; ?>
