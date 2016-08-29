<?php
$pagetitle = "My Account";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

$userID = $_SESSION['userID'];

$sql = "SELECT * from users WHERE userID='$userID'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);


?>

<div class="content">
<form method="post" action="../inc/updateaccount.php">
<fieldset>
    <h2>Account details</h2>
    <label>First Name</label><br />
    <input type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly /><br />
    <label>Last Name</label><br />
    <input type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly /><br />
    <label>DOB</label><br />
    <input type="date" value="<?php echo $row['DOB']?>" readonly /><br />
    <label>Gender</label><br />
    <label>Male</label>
    <input type="radio" name="gender" <?php if($row['gender'] == 'Male') {echo "checked";}?> readonly/>
    <label>Female</label>
    <input type="radio" name="gender" <?php if($row['gender'] == 'Female'){ echo "checked";}?> readonly /><br />
    <label>Facebook ID</label><br />
    <input type="text" name="facebookID" value="<?php echo $row['facebookId']?>" /><br />
    <label>Email</label><br />
    <input type="email" name="email" value="<?php echo $row['email']?>" /><br />
    <input type="submit" name="accountupdate" value="Update Details" />
    </fieldset>
    </form>


</div>