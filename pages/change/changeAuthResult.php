<?php
$pagetitle = "Change Authorisation";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
$userID = $_GET['userID'];
$sql = "SELECT * FROM users WHERE userID = '$userID'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$firstName = $row['firstName'];
$lastName = $row['lastName'];
echo "<div class='content'>";
?>
<div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../change/changeAuth.php">User Management</a> > Modify Authorization:<?php echo $firstName . " " . $lastName ?></span>
        </div>
<?php
$userID = $_GET['userID'];
$changeAccess = $_POST['accessChosen'];
//$userIDConvertedToInt = intval($userID);

$query = "UPDATE users SET accountType='$changeAccess' WHERE UserID=$userID";

// query to change
$sql = mysqli_query($con,$query) or die(mysqli_error($con));
$query = "SELECT userID, firstName, lastName FROM users WHERE userID='$userID'";
$sql = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_array($sql);

echo "<h3>" .$row['firstName'] . " " . $row['lastName'] . " changed to a " . $changeAccess . "</h3>";
echo "<p><a href='changeauth.php'>Back to Users</a></p>";

echo "</div>";
include "../../inc/footer.php";
?>
