<?php
$pagetitle = "Admin Leave Requests";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>
<div class="content centered">
    <?php
    include "searchLeave.php";

    //get variables from searchUsers on if they are set
if (isset($_POST["userID"])){
    $userID = $_POST["userID"];
} else {
    $userID = null;
}

if (isset($_POST["status"])){
    $status = $_POST["status"];
} else {
    $status = null;
}

    $column = array(
        'First Name' => 'firstName',
        'Last Name' => 'lastName',
        'Start Date' => 'startDate',
        'End Date' => 'endDate',
        'Reason' => 'reason',
        'Current Status' => 'status',
    );

    //show specified account type if set, otherwise show all account types
if ($status != null){
    $statuses = array(
         0 => $status
    );
} else {
    $statuses = array(
      1 => 'Pending',
      2 => 'Approved',
      3 => 'Denied'
    );
}

  if ($userID != null) {
      $sql = "SELECT leaverequests.*, users.firstName, users.lastName
      FROM leaverequests, users WHERE leaverequests.userID = users.UserID AND $userID = users.UserID";
      if ($status != null) {
        $sql = "SELECT leaverequests.*, users.firstName, users.lastName
        FROM leaverequests, users WHERE leaverequests.userID = users.UserID AND $userID = users.UserID
        AND '$status' = leaverequests.status";
      }

    } elseif ($status != null) {
      $sql = "SELECT leaverequests.*, users.firstName, users.lastName
      FROM leaverequests, users WHERE leaverequests.userID = users.UserID AND '$status' = leaverequests.status";
      if ($userID != null) {
        $sql = "SELECT leaverequests.*, users.firstName, users.lastName
        FROM leaverequests, users WHERE leaverequests.userID = users.UserID AND '$status' = leaverequests.status
        AND $userID = users.UserID";
      }
    } else {
        $sql = "SELECT leaverequests.*, users.firstName, users.lastName
        FROM leaverequests, users WHERE leaverequests.userID = users.userID";
    }
    $result = mysqli_query($con,$sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        echo "<h3>$type</h3>";
        echo "<table class='table centered'><tr>";

        echo"<script>
        $(document).ready(function()
            {
                $('#myTable').tablesorter();
            }
        );
        </script>";

        foreach ($column as $name => $col_name) {
          echo "<th>$name</th>";
        }

        echo "<th> Approve Leave </th>";
        echo "<th> Deny Leave </th>";


        while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($column as $name => $col_name) {
            echo "<td>";
            if($name == 'Approved') {
                if($row[$col_name] == null){
                  echo "<span>Please Select</span>";
              } elseif($row[$col_name] == 'Denied') {
                  echo "<span class='error'>'Denied'</span>";
              } elseif($row[$col_name] == 'Approved') {
                  echo "<span class='success'>'Approved'</span>";
              }
            } else {
                echo $row[$col_name];
            }
              echo "</td>";
          }
          echo '<td><a href="modifyLeave.php?leaveID='.$row['leaveID'] . '&approved=Approved"><img src="../../images/tick.png" /></a></td>';
          echo '<td><a href="modifyLeave.php?leaveID='.$row['leaveID'] . '&approved=Denied"><img src="../../images/cross.png" /></a></td>';

            echo '</tr>';

        }

        // Close table
        echo "</table><br>";
    } else if (sizeof($statuses) == 1){
        echo "<h3> No Leave Requests found. Search Again.";
        break;
    }
//}

    ?>

</div>


<?php
include "../../inc/footer.php";
?>
