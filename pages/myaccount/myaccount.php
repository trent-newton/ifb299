<?php
$pagetitle = "My Account";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/checkFunctions.php";
require "../../inc/authCheck.php";

$userID = $_SESSION['userID'];

$sql = "SELECT * FROM users LEFT JOIN useraddress ON users.UserID=useraddress.userID LEFT JOIN address ON useraddress.addressID=address.addressId WHERE users.userID='$userID' ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

$DOB = StringToDate($row['DOB'], "Y-m-d");
$age = GetAge($DOB);
?>
    <div class="content centered">
        <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <?php if((isOwner($_SESSION['accountType'])) || (isAdmin($_SESSION['accountType']))) { echo '<a href="../admin/admincenter.php">Admin Center</a>'; } else { echo '<a href="../usercenter/usercenter.php">User Center</a>'; } ?> > User Details</span>
        </div>
        <fieldset class="accountDetails">
            <form method="post" action="../../inc/updateaccount.php">
                <h3>Personal</h3>

                <label class="control-label">First Name (Read Only): </label>
                <input class="form-control" type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly />

                <label class="control-label">Last Name (Read Only): </label>
                <input class="form-control" type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly />

                <label class="control-label">DOB (Read Only): </label>
                <input class="form-control" type="date" value="<?php echo $row['DOB']?>" readonly />

                <label class="control-label">Gender (Read Only): </label>
                <div class="radio">
                    <label><input type="radio" name="gender" <?php if($row['gender']=='Male' ) {echo "checked";}?> readonly />Male</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="gender" <?php if($row['gender']=='Female' ){ echo "checked";}?> readonly />Female</label>
                </div>

                <h3>Address</h3>
                <label class="control-label">Unit: </label>
                <input class="form-control" type="text" name="unitNumber" value="<?php echo $row['unitNumber']?>" />

                <label class="control-label">Street No<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="streetNumber" value="<?php echo $row['streetNumber']?>" required />

                <label class="control-label">Street<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="streetName" value="<?php echo $row['streetName']?>" required />
                <select class="form-control" name="streetType" required>
                    <option value="Street" <?php if($row['streetType']== 'street'){ echo 'selected';} ?>>Street</option>
                    <option value="Close" <?php if($row['streetType']== 'close'){ echo 'selected';} ?>>Close</option>
                    <option value="Road" <?php if($row['streetType']== 'road'){ echo 'selected';} ?>>Road</option>
                    <option value="Chase" <?php if($row['streetType']== 'chase'){ echo 'selected';} ?>>Chase</option>
                </select>

                <label class="control-label">Suburb<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="suburb" value="<?php echo $row['suburb']?>" required />

                <label class="control-label">State<span class="required">*</span>:</label>
                <select class="form-control" name="state" >
                    <option value="QLD" <?php if($row['state'] == 'QLD'){echo "selected"; } ?>>QLD</option>
                    <option value="TAS" <?php if($row['state'] == 'TAS'){echo "selected"; } ?>>TAS</option>
                    <option value="NSW" <?php if($row['state'] == 'NSW'){echo "selected"; } ?>>NSW</option>
                    <option value="VIC" <?php if($row['state'] == 'VIC'){echo "selected"; } ?>>VIC</option>
                    <option value="WA" <?php if($row['state'] == 'WA'){echo "selected"; } ?>>WA</option>
                    <option value="NT" <?php if($row['state'] == 'NT'){echo "selected"; } ?>>NT</option>
                    <option value="ACT" <?php if($row['state'] == 'ACT'){echo "selected"; } ?>>ACT</option>
                </select>

                <label class="control-label">Postcode<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="postcode" value="<?php echo $row['postCode']?>" required />

                <h3>Contact Info</h3>

                <label class="control-label">Facebook ID: </label>
                <input class="form-control" type="text" name="facebookID" value="<?php echo $row['facebookId']?>" />

                <label class="control-label">Email<span class="required">*</span>: </label>
                <input class="form-control" class="emailInput" type="email" name="email" value="<?php echo $row['email']?>" />
                <?php
                    $sqlPhone = "SELECT * FROM phonenumbers WHERE userID='$userID'";
                    $resultPhone = mysqli_query($con, $sqlPhone);
                    $n = 0;
                    while ($rowPhone = mysqli_fetch_array($resultPhone)) {
                        echo "<label class='control-label'>Phone " . $n . ": </label>";
                        echo "<input class='form-control' type='text' name='phone" . $n . "' value='" . $rowPhone['phoneNumber'] . "' />";
                        $n++;
                    }
                ?>

                <label class="control-label">Phone <?php echo $n ?>: </label>
                <input class='form-control' type="text" value="" name="phone<?php echo $n?>" />
                <input class='form-control' type="hidden" name="numPhones" value="<?php echo $n?>" />

                <?php
                    if ($age < 18) {
                        echo "<h3>Parent Info</h3><h4>";
                        echo "<label class='control-label'>Parent's Name<span class='required'>*</span>: </label>";
                        echo "<input class='form-control' type='text' name='parentName' value='".$row['parentName']."' required>";
                        echo "<label class='control-label'>Parent's Email<span class='required'>*</span>: </label>";
                        echo "<input class='form-control' type='email' name='parentEmail' value='".$row['parentEmail']."' required>";
                    }
                ?>

                <input class='form-control' type="hidden" name="userID" value="<?php echo $userID?>" />

                <input class='form-control' type="submit" name="accountupdate" value="Update Details" />
            </form>
        </fieldset>
        <fieldset class="changePassword">
            <form method="post" action="inc/changepassword.php">
                <h3>Change Password</h3>
                <label class="control-label">Current Password: </label>
                <input class='form-control' type="password" name="oldPassword" required />

                <label class="control-label">New Password: </label>
                <input class='form-control' type="password" name="newPassword" required />

                <label class="control-label">Confirm New Password: </label>
                <input class='form-control' type="password" name="newPassword2" required  />

                <input class='form-control' type="hidden" name="userID" value="<?php echo $userID ?>" />
                <input class='form-control' type="submit" name="changepassword" value="Change Password" />
            </form>
        </fieldset>
    </div>
<?php
include "../../inc/footer.php";
?>
