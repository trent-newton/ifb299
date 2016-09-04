<?php

$pagetitle = "Enrol";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

$chosenInstrument = $_POST['chosenInstrument'];
$chosenLanguage = $_POST['chosenLanguage'];
$chosenStartTime = $_POST['chosenStartTime'];
$chosenDay = $_POST['chosenDay'];

$columnTeacherDetails  = array(
    'teacherID' => 'teacherID',
    'Day' => 'day',
    'Start Time' => 'startTime',
    'End Time' => 'endTime'
);

echo "<h1> Here are all the times for $chosenInstrument classes in $chosenLanguage on $chosenDay starting at $chosenStartTime</h1>";

$query ="SELECT DISTINCT availability.teacherID, availability.teacherID, availability.day, availability.startTime, availability.endTime  
        FROM availability INNER JOIN languages 
        WHERE availability.teacherID = languages.userID 
        AND languages.language = '$chosenLanguage' 
        AND availability.startTime <= '$chosenStartTime'"; //possibly add another condition for end time??

$result = mysqli_query($con, $query);  

//start table
echo "<table><tr>";
    //table headings
    foreach ($columnTeacherDetails as $name => $col_name) {
      echo "<th>$name</th>";
    }
    echo "<th>Select Class</th>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($columnTeacherDetails as $name => $col_name) {
        echo "<td> $row[$col_name] </td>";
        $teacherID = $row['teacherID'];
  }
    echo "<td><a href='enrolClassTimeProcess.php?day=$chosenDay&startTime=$chosenStartTime&instrument=$chosenInstrument&teacherID=$teacherID'";

    
    echo "><span class='changeAccess'> Select Class </span> </td>";
}

// Close table
    echo "</table><br>";

include "../inc/footer.php";
?>