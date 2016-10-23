  <?php
    $pagetitle = "View Teacher Applications";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";

    if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Administrators can review Teacher Applications.";
        rejectAccess();
    }
?>


<div class="content">
  <div class="breadcrumb">
      <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > Review Teacher Applications</span>
  </div>
<div class="adminCenter">


    <h1>Review Teacher Applications</h1>
    <br>
    <br>


    <table class="table" id="myTable" class="centerTable">
      <tr><th>Name</th><th>Age</th><th>Instruments</th><th>Languages</th><th>Availability</th><th></th></tr>
<?php
        $sql = "SELECT applications.userID, users.DOB, applications.instrument, applications.language, applications.availability, users.firstname, users.lastname
                FROM applications INNER JOIN users ON applications.userID = users.userID";
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result))
        {
          echo '<tr>';
          $age = floor((time() - strtotime($row['DOB'])) / 31556926);
          echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
          echo '<td>'.$age.'</td>';
          echo '<td>'.$row['instrument'].'</td>';
          echo '<td>'.$row['language'].'</td>';
          echo '<td>'.$row['availability'].'hrs</td>';
          echo '<td><a href="../admin/adminViewFullApplication.php?userID='.$row['userID'].'"><span class="changeAccess"> Read more </span></a></td>';
          echo '</tr>';
        }

?>
    </table>
</div></div>

    <?php
        include "../../inc/footer.php";
    ?>
