<?php
$pagetitle = "Change Schedule";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$contractID = $_GET['contractID'];
$userID = $_GET['userID'];

//INSERT INTO `pinelands_ms`.`contracts` (`contractID`, `teacherID`, `studentID`, `startDate`, `endDate`, `time`, `day`, `length`, `instrument`) VALUES ('15', '2', '4', '2016-09-07', '2016-09-14', '13:00:00', 'Friday', '30', 'Oboe');

$command= mysqli_query($con,"DELETE FROM contracts WHERE contractID=$contractID");
if(mysql_affected_rows() == 1)
{
  echo "The class was successfully removed";
}

$result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
$name = mysqli_fetch_array($result);
echo "<h1> Change schedule for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";

$sql = "SELECT contracts.*,users.firstName ,users.lastName  FROM contracts INNER JOIN users ON userID=studentID WHERE teacherID=$userID";
$result = mysqli_query($con, $sql);
$table = mysqli_fetch_all($result);


?>
