<?php
$reviewType = $_GET['reviewType'];
$pagetitle = $reviewType . " Reviews";
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
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/adminReviewCenter.php">Admin Review Center</a> > <?php echo $reviewType?> Reviews</span>
        </div>
<div class="centered">
    <h1><?php echo $reviewType ?> Reviews</h1>

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
$sql = "SELECT teacherreviews.*,users.firstName AS studFN, users.lastName AS studLN, stuff.firstName AS teachFN, stuff.lastName AS teachLN FROM users INNER JOIN teacherreviews ON userID=studentID INNER JOIN users AS stuff ON stuff.userID= teacherreviews.teacherID WHERE reviewStatus = '$reviewType'";
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
      echo '<img class="reviewTableIcon" src="../../images/admin-icons/reviews/' . $reviewType . '.png" />';
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
