<?php
$pagetitle = "Request for Leave";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";
include "../../inc/leaverequestprocessing.php";

//allows access to teachers or students
if(!isStudent($_SESSION['accountType']) && !isStudentTeacher($_SESSION['accountType']) && !isTeacher($_SESSION['accountType'])){
    rejectAccess();
}
?>
<div class="content">
     <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../usercenter/usercenter.php">User Center</a> > Leave Request</span>
        </div>
<div class="reviewLessonForm">
    
<h2>Request Leave</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label id="lblStartDate" for="txtStartDate">Start Date<span class="required">*</span>:</label>

<?php
$mondayTimestamp = strtotime('monday this week');
$output = [];
for ($day = 0; $day < 31; $day++) {
    $output[] = date('Y-m-d', strtotime(sprintf('+%d days', $day), $mondayTimestamp));
}
 ?>
    <select name="startDate" id="txtStartDate" required>
      <?php foreach ($output as $day) : ?>
          <option value="<?php echo $day ?>"><?php echo $day ?></option>
      <?php endforeach; ?>

    </select>

    <label id="lblEndDate" for="txtEndDate">End Date<span class="required">*</span>:</label>

    <select name="endDate" id="txtEndDate" required>
      <?php foreach ($output as $day) : ?>
          <option value="<?php echo $day ?>"><?php echo $day ?></option>
      <?php endforeach; ?>
    </select>
    <br/>
    <label id="lblReason" for="txtReason">Reason<span class="required">*</span>: </label>
    <textarea class="form-control" type="reason" rows="5" name="reason" id="txtReason" value="<?php if (isset($_POST['comment'])) echo $_POST['reason'] ?>"></textarea>
        <?php echo "<span class='required'>  ".$errorComment."</span>" ?>


        <?php

          $userID = $_SESSION['userID'];

        //Pass other key information to reviewprocessing.php
        echo '<input type="hidden" value="' .$userID. '" name="userID" />';
        ?>

    <input class="form-control"type="submit" name="submit" value="Submit" />

  </form>
</div>
<br>
<br>
  <hr>

  <h2>Previous Leave Requests</h2>

  <?php
  $sql = "SELECT * FROM leaverequests WHERE userID='$userID'";
  $result = mysqli_query($con, $sql);
  $rowCount = mysqli_num_rows($result);
  if ($rowCount > 0) {
   ?>

  <table class="table" id="myTable" class="tablesorter centerTable">
<thead>

<script>
$(document).ready(function()
    {
        $("#myTable").tablesorter();
    }
);
</script>

<?php

echo '<tr>
  <th>Date Requested</th>
  <th>Reason Provided</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>Status</th>
</tr>
</thead>
<tbody>';

while ($row = mysqli_fetch_array($result)) {
echo '<tr>
  <td>';
  echo $row["requestDate"];
  echo '</td>
  <td>';
  echo $row["reason"];
  echo '</td>
  <td>';
  echo $row["startDate"];
  echo'</td>
  <td>';
  echo $row["endDate"];
  echo '</td>
  <td>';
  // echo '<a style="display:inline-block;" href="../change/changeReviewStatus.php?reviewID='.$row['reviewID'].'">';

  if ($row["status"] == 'Approved') {
    echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/public.png" />';
  }
  elseif ($row["status"] == 'Pending') {
    echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/pending.png" />';
  }
  elseif ($row["status"] == 'Denied') {
    echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/private.png" />';
  }
  else {
    echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/invalid.png" />';
  }

  echo $row["status"];
  echo'</a>
  </td>
</tr>';
}
echo '</tbody>
</table>';
} else {
  echo "<h3> No Previous Leave Requests found.";
}
?>
</div>
<?php
include "../../inc/footer.php";
?>
