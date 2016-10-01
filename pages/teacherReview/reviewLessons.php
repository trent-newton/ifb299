<?php
$pagetitle = "Review Lessons";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if(!isStudent($_SESSION['accountType']) && !isStudentTeacher($_SESSION['accountType']) && !isTeacher($_SESSION['accountType'])){
    rejectAccess();
}
?>

<h3>Lessons to Review</h3>

<table id="myTable" class="tablesorter centerTable">
<thead>

<script>
$(document).ready(function()
  {
      $("#myTable").tablesorter();
  }
);
</script>

<?php
  //Find this user's contracts and link them with the teacher's name
  $sql = "SELECT contracts.*, users.firstName, users.lastName FROM users INNER JOIN contracts ON users.userID=contracts.teacherID WHERE $userID = contracts.studentID";
  $result = mysqli_query($con, $sql);

  echo '<tr>
      <th>Teacher Name</th>
      <th>Contract Start</th>
      <th>Contract End</th>
      <th>Instrument</th>
      <th>Review</th>
  </tr>
  </thead>
  <tbody>';

  //Display a list of all the contracts for this user
  while ($row = mysqli_fetch_array($result)) {
    //Limit list to only contracts that have expired
    if (new DateTime() > new DateTime($row["endDate"])) {

      $currentContractID = $row['contractID'];
      $sql2 = "SELECT teacherreviews.contractID FROM teacherreviews WHERE teacherreviews.contractID = $currentContractID";
      $result2 = mysqli_query($con, $sql2);
      $counter = 0;
      while ($row2 = mysqli_fetch_array($result2)) {
        $counter = $counter + 1;
      }
      if ($counter == 0) {
        echo '<tr>
        <td>';
        echo $row["firstName"];
        echo ' ';
        echo $row["lastName"];
        echo '</td>
        <td>';
        echo $row["startDate"];
        echo '</td>
        <td>';
        echo $row["endDate"];
        echo'</td>
        <td>';
        echo $row["instrument"];
        echo'</td>
        <td><a href="writeReview.php?contractID='.$row['contractID'].'">Review Now</a>
        </td>
        </tr>';
      }
    }
  }
    echo '</tbody>
    </table>
    </div>';
?>

<?php
include "../../inc/footer.php";
?>
