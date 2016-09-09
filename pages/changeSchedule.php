<?php
$pagetitle = "Change Schedule";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$userID = $_GET['userID'];

$result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
$name = mysqli_fetch_array($result);

echo "<h1> Change schedule for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";

$sql = "SELECT contracts.*,users.firstName ,users.lastName  FROM contracts INNER JOIN users ON userID=studentID WHERE teacherID=$userID";
$result = mysqli_query($con, $sql);
$table = mysqli_fetch_all($result);

echo '<table style="width:25%; font-size:120%">';
foreach($table as $rowNum => $row)
{
  echo '<tr><td>';
  //prints out teachers name
  echo "Teacher: ".$row[9]." ".$row[10]."<br>";
  echo "Class time: ".$row[5]."<br>";
  echo "Duration: ".$row[7]." minutes<br>";
  echo "Day: ".$row[6]."<br>";
  echo "Instrument: ".$row[8]."<br>";
  echo "Start date: ".$row[3]."<br>";
  echo "End date: ".$row[4]."<br>";
  echo '<a href="changeScheduleProcess.php?contractID='.$row[0].'&userID='.$row[1].'"><span class="changeAccess" style="font-size:125%"> Remove class </span></a>';
  foreach($row as $field => $value)
  {
    echo $field.": ".$value . " ";
  }
  echo '</td></tr>';
}
echo '</table>';

?>
