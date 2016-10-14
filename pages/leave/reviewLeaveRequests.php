<?php
$pagetitle = "Review Center";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>
<div class="content">
<div class="adminCenter">
    <h1>Welcome to the Leave Request Center</h1> <h3>Which leave requests would you like to review?</h3>

    <div>
        <div class="temp"><a href="../leave/reviewPendingRequests.php"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/pending.png"></a>
           <br><a href="adminReviewPending.php" class="button">Pending</a>
        </div>

        <div class="temp"><a href="../leave/reviewApprovedRequests.php"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/public.png"></a>
           <br><a href="adminReviewPublic.php" class="button">Approved</a>
        </div>

        <div class="temp"><a href="../leave/reviewDeniedRequests.php"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/private.png"></a>
           <br><a href="adminReviewPrivate.php" class="button">Denied</a>
        </div>
    </div>

    <h3>All Leave Requests</h3>

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
  $sql = "SELECT leaverequests.*, users.firstName, users.lastName FROM leaverequests, users WHERE leaverequests.userID = users.userID";
  $result = mysqli_query($con, $sql);


  echo '<tr>
    <th>Name</th>
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
    echo $row["firstName"];
    echo ' ';
    echo $row["lastName"];
    echo'</td>
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

    echo $row["status"];
    echo'</a>
    </td>
  </tr>';
  }
  echo '</tbody>
  </table>';
  ?>
</div> <!--end content-->

<?php include "../../inc/footer.php"; ?>
