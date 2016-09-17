<?php
$pagetitle = "User Management";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
require "../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$column = array(
  'First Name' => 'firstName',
  'Last Name' => 'lastName'
);

// array of account Types
$accountTypes = array(
    0 => "Guest",
    1 => "Student",
    2 => "Teacher",
    3 => "StudentAndTeacher",
    4 => "Admin",
);

foreach ($accountTypes as $type) {
    //run query based on account type
    $result= mysqli_query($con,"SELECT userID, firstName, lastName FROM users WHERE accountType='$type'");

    //account type headings
    echo "$type accounts <br>";
    echo "<table id='changeAuthTables'><tr>";
    //table headings
    foreach ($column as $name => $col_name) {
      echo "<th>$name</th>";
    }

    echo "<th> Change Details </th>";
    echo "<th> Change Access </th>";
    echo "<th> Change Schedule </th> </tr>";

    // Output rows
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      foreach ($column as $name => $col_name) {
        echo "<td>". $row[$col_name] . "</td>";
      }
      echo '<td><a href="adminModifyAccount.php?userID='.$row['userID'].'"><span class="changeAccess"> change details </span></a></td>';
      echo '<td><a href="changeAuthProcess.php?userID='.$row['userID'].'"><span class="changeAccess"> change access </span></a></td>';
      if(($type !== "Admin") && ($type !== "Owner") && ($type !== "Guest") && ($type !== "Teacher"))
      {
        echo '<td><a href="changeSchedule.php?userID='.$row['userID'].'"><span class="changeAccess"> change schedule </span></a></td></tr>';
      } else {
        echo '<td></td></tr>';
      }
    }

    // Close table
    echo "</table><br>";
}

include "../inc/footer.php";
?>
