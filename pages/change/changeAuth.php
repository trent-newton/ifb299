<?php
$pagetitle = "User Management";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
echo "<div class='content changeAuth'>";

include "../listUsers/searchUsers.php";

//get variables from searchUsers on if they are set
if (isset($_POST["userID"])){
    $userID = $_POST["userID"];
} else {
    $userID = null;
}

if (isset($_POST["accountType"])){
    $accountType = $_POST["accountType"];
} else {
    $accountType = null;
}


$column = array(
  'userID' => 'userID', 
  'First Name' => 'firstName',
  'Last Name' => 'lastName'
);

//show specified account type if set, otherwise show all account types  
if ($accountType != null){
    $accountTypes = array(
         0 => $accountType
    );
} else {
    $accountTypes = array(
        0 => "Guest",
        1 => "Student",
        2 => "Teacher",
        3 => "StudentAndTeacher",
        4 => "Admin",
    );
}

foreach ($accountTypes as $type) {
    //if userID set show only that user, else show all of this account type
    if ($userID != null){
         $result= mysqli_query($con,"SELECT userID, firstName, lastName FROM users WHERE userID='$userID' and accountType='$type'");
    } else {
         $result= mysqli_query($con,"SELECT userID, firstName, lastName FROM users WHERE accountType='$type'");   
    }
    
    //only create table if account type has 1 or more users
    if (mysqli_num_rows($result) > 0) {
        echo "$type accounts <br>";
        echo "<table id='changeAuthTables'><tr>";
        
        foreach ($column as $name => $col_name) {
          echo "<th>$name</th>";
        }

        echo "<th> Change Details </th>";
        echo "<th> Change Access </th>";
        echo "<th> Change Schedule </th> </tr>";

        while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($column as $name => $col_name) {
            echo "<td>". $row[$col_name] . "</td>";
          }
          echo '<td><a href="../admin/adminModifyAccount.php?userID='.$row['userID'].'"><span class="changeAccess"> change details </span></a></td>';
          echo '<td><a href="../change/changeAuthProcess.php?userID='.$row['userID'].'"><span class="changeAccess"> change access </span></a></td>';
          if(($type !== "Admin") && ($type !== "Owner") && ($type !== "Guest") && ($type !== "Teacher"))
          {
            echo '<td><a href="../change/changeSchedule.php?userID='.$row['userID'].'"><span class="changeAccess"> change schedule </span></a></td></tr>';
          } else {
            echo '<td></td></tr>';
          }
        }

        // Close table
        echo "</table><br>";
    } else if (sizeof($accountTypes) == 1){
        echo "<h3> No users found. Search Again.";
    }
}

echo "</div>";
include "../../inc/footer.php";
?>