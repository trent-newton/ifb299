<?php
$pagetitle = "Change Schedule";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/bootstrap.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$contractID = $_GET['contractID'];
$userID = $_GET['userID'];

//INSERT INTO `pinelands_ms`.`contracts` (`contractID`, `teacherID`, `studentID`, `startDate`, `endDate`, `time`, `day`, `length`, `instrument`) VALUES ('15', '2', '4', '2016-09-07', '2016-09-14', '13:00:00', 'Friday', '30', 'Oboe');

$command= mysqli_query($con,"DELETE FROM contracts WHERE contractID=$contractID");



$result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
$name = mysqli_fetch_array($result);
echo "<h1> Change schedule for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";

$checkRemoved = mysqli_query($con,"SELECT * FROM contracts WHERE contractID = $contractID");
$count = mysqli_num_rows($checkRemoved);
if ($count == 0) {
  echo "<h3> The class for ".$name['firstName']." ".$name['lastName']." was successfully removed</h3>";
} else {
  echo "<h3> There has been an error. OH dear oh me.</h3>";
}
echo '<a href="enrol.php?userID='.$userID.'" ><span style="font-size:145%">Add a new class</span></a>';
$sql = "SELECT contracts.*,users.firstName ,users.lastName  FROM contracts INNER JOIN users ON userID=studentID WHERE teacherID=$userID";
$result = mysqli_query($con, $sql);
$table = mysqli_fetch_all($result);


?>
