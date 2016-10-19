<?php
    $pagetitle = "User Management";
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
<div class="adminCenter">
<?php
//if there is no userID in the address bar then give error. If there is then it proceeds like normal
  if(isset($_GET['userID'])) {

    $userID = $_GET['userID'];
    $sql = "SELECT applications.userID, users.DOB, applications.language, applications.availability, users.firstname, users.lastname, instrumentnames.instrumentname
    FROM applications INNER JOIN users ON applications.userID = users.userID
    INNER JOIN instrumentnames ON instrumentnames.instrumentTypeID = applications.instrument";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    echo '<h1>Review '.$row['firstname'].' '.$row['lastname']."'s".' Applications</h1>';

      echo '<a href="../../applicationUploads/'.$row['userID'].'.txt">Download Resume</a>';

  } else {
    echo '<h1>An error has occured. Please go back to the previous page.</h1>';
  }
?>
</div></div>

    <?php
        include "../../inc/footer.php";
    ?>
