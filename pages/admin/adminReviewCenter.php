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
    <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > Admin Review Center</span>
        </div>
<div class="centered">
    <h1>Welcome to the Admin Review Center</h1> <h3>Which reviews would you like to review?</h3>

    <div>
        <div class="common"><a href="../admin/adminReview.php?reviewType=Pending"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/pending.png"></a>
           <br><a href="adminReview.php?reviewType=Pending" class="button">Pending</a>
        </div>

        <div class="common"><a href="../admin/adminReview.php?reviewType=Public"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/public.png"></a>
           <br><a href="adminReview.php?reviewType=Public" class="button">Public</a>
        </div>

        <div class="common"><a href="../admin/adminReview.php?reviewType=Private"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/private.png"></a>
           <br><a href="adminReview.php?reviewType=Private" class="button">Private</a>
        </div>

        <div class="common"><a href="../admin/adminReview.php?reviewType=Invalid"><img class="AdminCenterImage" src="../../images/admin-icons/reviews/invalid.png"></a>
           <br><a href="adminReview.php?reviewType=Invalid" class="button">Invalid</a>
        </div>
    </div>

    <h3>All Reviews</h3>

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
    echo '<a style="display:inline-block;" href="../change/changeReviewStatus.php?reviewID='.$row['reviewID'].'">';

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
