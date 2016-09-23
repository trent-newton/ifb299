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
    <h1>Welcome to the Admin Review Center</h1> <h3>Which reviews would you like to review?</h3>

    <div>
        <div class="temp"><a href="../admin/adminReviewPending.php"><img class="AdminCenterImage" src="../images/admin-icons/reviews/pending.png"></a>
           <br><button class="AdminCenterButton reviewButton"><a href="adminReviewPending.php" class="button">Pending</a></button>
        </div>

        <div class="temp"><a href="../admin/adminReviewPublic.php"><img class="AdminCenterImage" src="../images/admin-icons/reviews/public.png"></a>
           <br><button class="AdminCenterButton reviewButton"><a href="adminReviewPublic.php" class="button">Public</a></button>
        </div>

        <div class="temp"><a href="../admin/adminReviewPrivate.php"><img class="AdminCenterImage" src="../images/admin-icons/reviews/private.png"></a>
           <br><button class="AdminCenterButton reviewButton"><a href="adminReviewPrivate.php" class="button">Private</a></button>
        </div>

        <div class="temp"><a href="../admin/adminReviewInvalid.php"><img class="AdminCenterImage" src="../images/admin-icons/reviews/invalid.png"></a>
           <br><button class="AdminCenterButton reviewButton"><a href="adminReviewInvalid.php" class="button">Invalid</a></button>
        </div>
    </div>

    <h3>All Reviews</h3>

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
$sql = "SELECT teacherreviews.*,users.firstName AS studFN, users.lastName AS studLN, stuff.firstName AS teachFN, stuff.lastName AS teachLN FROM users INNER JOIN teacherreviews ON userID=studentID INNER JOIN users AS stuff ON stuff.userID= teacherreviews.teacherID";
$result = mysqli_query($con, $sql);


echo '<tr>
    <th>Teacher Name</th>
    <th>Student Name</th>
    <th>Comment</th>
    <th>Rating</th>
    <th>Date</th>
    <th>Status</th>
</tr>
</thead>
<tbody>';

while ($row = mysqli_fetch_array($result)) {
echo '<tr>
    <td>';
    echo $row["teachFN"];
    echo ' ';
    echo $row["teachLN"];
    echo '</td>
    <td>';
    echo $row["studFN"];
    echo ' ';
    echo $row["studLN"];
    echo '</td>
    <td>';
    echo $row["reviewComment"];
    echo'</td>
    <td>';
    echo $row["reviewRating"];
    echo '</td>
    <td>';
    echo $row["reviewDate"];
    echo'</td>
    <td>';
    echo '<a style="display:inline-block;" href="changeReviewStatus.php?reviewID='.$row['reviewID'].'">';

    if ($row["reviewStatus"] == 'Public') {
      echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/public.png" />';
    }
    elseif ($row["reviewStatus"] == 'Pending') {
      echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/pending.png" />';
    }
    elseif ($row["reviewStatus"] == 'Private') {
      echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/private.png" />';
    }
    else {
      echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/invalid.png" />';
    }

    echo $row["reviewStatus"];
    echo'</a>
    </td>
</tr>';
}
echo '</tbody>
</table>
</div>';
?>
</div> <!--end content-->

<?php include "../../inc/footer.php"; ?>
