<?php
    $pagetitle = "User Management";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";

    if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Administrators can review Teacher Applications .";
        rejectAccess();
    }
?>


<div class="content">
<div class="adminCenter">


    <h1>Review Teacher Applications</h1>
    <br>
    <br>



    <table class="table" id="myTable" class="centerTable">
      <th>Name<th><th>Age<th><th>Instruments<th><th>Languages<th><th><th>
<?php
        while($row = mysqli_fetch_array($result))
        {
          $age = floor((time() - strtotime($row['DOB'])) / 31556926);
          echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
          echo '<td>'.$age.'</td>';
          echo '<td>'.$row['instruments'].'</td>';
          echo '<td>'.$row['languages'].'</td>';
          echo '<td>'.$row['instruments'].'</td>';
          echo '<td><a href="../admin/adminViewFullApplication.php?userID='.$row['userID'].'"><span class="changeAccess"> Read more </span></a></td>';
        }

?>
    </table>
</div></div>

    <?php
        include "../../inc/footer.php";
    ?>
