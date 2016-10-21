<?php
$pagetitle = "Change Schedule";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
?>
<div class="content">
<div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../../pages/change/changeAuth.php">User Management</a> > Change Schedule</span>
        </div>
<?php
$userID = $_GET['userID'];

$result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
$name = mysqli_fetch_array($result);

echo "<h1> Change schedule for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
$sql='';

$sql = "SELECT contracts.*,users.firstName ,users.lastName  FROM contracts INNER JOIN users ON userID=teacherID  WHERE studentID=$userID";


$result = mysqli_query($con, $sql);
$table = mysqli_fetch_all($result);
$rowcount=mysqli_num_rows($result);
//checks size of query
if($rowcount == 0)
{
  echo "<h2>".$name['firstName']." ".$name['lastName']." is not enroled in any classes</h2>";
}

echo '<a href="../enrol/enrolClassTimes.php?userID='.$userID.'" ><span style="font-size:145%">Add a new class</span></a>';
echo '<table class="table" style="width:100%; font-size:120%">';
echo "<tr>";

$count = 0;
foreach($table as $rowNum => $row)
{
  $count++;
  echo '<td>';
  echo "Student: ".$name['firstName']." ".$name['lastName']."<br>";
  echo "Teacher: ".$row[9]." ".$row[10]."<br>";
  echo "Class time: ".$row[5]."<br>";
  echo "Duration: ".$row[7]." minutes<br>";
  echo "Day: ".$row[6]."<br>";
  echo "Instrument: ".$row[8]."<br>";
  echo "Start date: ".$row[3]."<br>";
  echo "End date: ".$row[4]."<br>";
  echo '<a href="changeScheduleProcess.php?contractID='.$row[0].'&userID='.$userID.'"><span class="changeAccess" style="font-size:125%"> Remove class </span></a>';
    
  //start new row after 3 columns
  if ($count == 3){
      echo '</tr><tr>';
      $count = 0;
  }

  echo '</td>';
}
echo '</tr></table>';
echo '</div>';

include "../../inc/footer.php";
?>
