<?php
$pagetitle = "enrol";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

// get sent through data
$day = $_GET['day'];
$startTime = $_GET['startTime'];
$instrument = $_GET['instrument'];
$teacherID = $_GET['teacherID'];
$studentID = $_SESSION['userID'];

$query = "INSERT INTO contracts (teacherID, studentID, startDate, endDate, time, day, length, instrument)
VALUES ($teacherID, $studentID, 1980-09-06, 1980-09-06, '$startTime', '$day', '60', '$instrument')";

echo $studentID;
echo $teacherID;
echo $startTime;
echo $instrument;
echo $day;

include "../inc/footer.php";
?>