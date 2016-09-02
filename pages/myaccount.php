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
        
        <fieldset class="accountDetails">
            <form method="post" action="../inc/updateaccount.php">
                <h2>Account details</h2>
                <label>First Name</label>
                <br />
                <input type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly />
                <br />
                <label>Last Name</label>
                <br />
                <input type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly />
                <br />
                <label>DOB</label>
                <br />
                <input type="date" value="<?php echo $row['DOB']?>" readonly />
                <br />
                <label>Gender</label>
                <br />
                <label>Male</label>
                <input type="radio" name="gender" <?php if($row[ 'gender']=='Male' ) {echo "checked";}?> readonly/>
                <label>Female</label>
                <input type="radio" name="gender" <?php if($row[ 'gender']=='Female' ){ echo "checked";}?> readonly />
                <br />
                <label>Facebook ID</label>
                <br />
                <input type="text" name="facebookID" value="<?php echo $row['facebookId']?>" />
                <br />
                <label>Email</label>
                <br />
                <input type="email" name="email" value="<?php echo $row['email']?>" />
                <br />
                <label>Parent's Name</label><br />
                <input type="text" name="parentName" value="<?php echo $row['parentName']?>" /><br />
                <label>Parent's Email</label><br />
                <input type="text" name="parentEmail" value="<?php echo $row['parentEmail']?>" /><br />
                <input type="hidden" name="userID" value="<?php echo $userID?>" />
                <input type="submit" name="accountupdate" value="Update Details" />            
            </form>
        </fieldset>
        <fieldset class="changePassword">
            <form method="post" action="../inc/changepassword.php">
                <h2>Change Password</h2>
                <label>Current Password:</label>
                <br />
                <input type="password" name="oldPassword" required />
                <br />
                <label>New Password:</label>
                <br />
                <input type="password" name="newPassword" required />
                <br />
                <label>New Password Again:</label>
                <br />
                <input type="password" name="newPassword2" required />
                <br />
                <input type="hidden" name="userID" value="<?php echo $userID?>" />

                <input type="submit" name="changepassword" value="Change Password" /> 
            </form>
        </fieldset>
    </div>