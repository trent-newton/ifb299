<?php
$pagetitle = "Invalid Reviews";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>
<div class="content">
<div class="adminCenter">
    <h1>Pending Reviews</h1>

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
$sql = "SELECT teacherreviews.*,users.firstName AS studFN, users.lastName AS studLN, stuff.firstName AS teachFN, stuff.lastName AS teachLN FROM users INNER JOIN teacherreviews ON userID=studentID INNER JOIN users AS stuff ON stuff.userID= teacherreviews.teacherID WHERE reviewStatus = 'Invalid'";
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
      echo '<img class="reviewTableIcon" src="../images/admin-icons/reviews/invalid.png" />';
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

<?php include "../inc/footer.php"; ?>
