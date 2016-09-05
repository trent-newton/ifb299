<?php
$pagetitle = "enrol";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

// get sent through data
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$instrument = $_POST['instrument'];
$teacherID = $_POST['teacherID'];
$studentID = $_SESSION['userID'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$sql = "INSERT INTO contracts (teacherID, studentID, startDate, endDate, time, day, length, instrument) VALUES ('$teacherID', '$studentID', '$startDate', '$endDate', '$startTime', '$day', '60', '$instrument')";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

?>
<div class="content enrolPage">
    <h2>Class Added</h2>
    <p>Start Date: <?php echo $startDate?></p>
    <p>End Date: <?php echo $endDate?></p>
    <p>Day: <?php echo $day?></p>
    <p>Time: <?php echo $startTime?></p>
    <p>Instrument: <?php echo $instrument?></p>

</div>

<?php

include "../inc/footer.php";
?>