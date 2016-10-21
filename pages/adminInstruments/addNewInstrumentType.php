<?php
$pagetitle = "New School Instrument";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
if(isset($_POST['submit'])) {
    $instrumentName = $_POST['instrumentName'];
    $checkForSQL = preg_match('/SELECT|DELETE|INSERT|[^\w\s]*/i',$instrumentName);
    if($checkForSQL == null)
    {
      $sql = "INSERT INTO instrumentnames (instrumentName) VALUES ('$instrumentName')";
      echo $sql;
      $result = mysqli_query($con, $sql) or die(mysqli_error($con));

      if($result) {
          $_SESSION['success'] = "Instrument Added";
          header("location:addNewInstrumentType.php");
          exit();
      } else {
          $_SESSION['error'] = "An error occured.";
          header("location:addNewInstrumentType.php");
          exit();
      }
    } else {
      $_SESSION['error'] = "Non-alphanumerical characters and Sql injection is not allowed.";
      header("location:addNewInstrumentType.php");
      exit();
    }

}
?>
<div class="content">
<div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/instrumentsAdmin.php">Instrument Admin</a> > Create New Instrument</span>
        </div>

<div class="loginForm center-horizontal">
    <h2>Create New Instrument Type</h2>

    <form method="POST" action="addNewInstrumentType.php">
        <label>Instrument Type</label><br />
        <input class="form-control" type="text" name="instrumentName" /><br>

        <input class="form-control" type="submit" name="submit" value="Add Instrument to Database" />

    </form>
</div>
</div>

<?php
include "../../inc/footer.php";
?>