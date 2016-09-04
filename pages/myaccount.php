<?php
$pagetitle = "My Account";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
include "../inc/logincheck.php";
$userID = $_SESSION['userID'];

$sql = "SELECT * FROM `users` INNER JOIN useraddress ON users.UserID=useraddress.userID Inner JOIN address ON useraddress.addressID=address.addressId WHERE users.userid='$userID' ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);


?>
    <div class="content">
        
        <fieldset class="accountDetails">
            <form method="post" action="../inc/updateaccount.php">
                <h2>Account details</h2>
                <label>First Name (Read Only):</label>
                <br />
                <input type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly />
                <br />
                <label>Last Name (Read Only):</label>
                <br />
                <input type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly />
                <br />
                <label>DOB (Read Only):</label>
                <br />
                <input type="date" value="<?php echo $row['DOB']?>" readonly />
                <br />
                <label>Gender (Read Only):</label>
                <br />
                <label>Male</label>
                <input type="radio" name="gender" <?php if($row['gender']=='Male' ) {echo "checked";}?> readonly/>
                <label>Female</label>
                <input type="radio" name="gender" <?php if($row['gender']=='Female' ){ echo "checked";}?> readonly />
                <br />
                <label>Unit:</label>
                <input type="text" name="unitNumber" size="2" value="<?php echo $row['unitNumber']?>" />
                <label>Street No<span class="required">*</span>:</label>
                <input type="text" name="streetNumber" value="<?php echo $row['streetNumber']?>" size="2" required />
                <br />
                <label>Street<span class="required">*</span>:</label>
                <br />
                <input type="text" name="streetName" value="<?php echo $row['streetName']?>" required />
                <br />
                <label>Street Type<span class="required">*</span>:</label>
                <br />
                <select name="streetType" required>
                    <option value="Street" <?php if($row['streetType']== 'street'){ echo 'selected';} ?>>Street</option>
                    <option value="Close" <?php if($row['streetType']== 'close'){ echo 'selected';} ?>>Close</option>
                    <option value="Road" <?php if($row['streetType']== 'road'){ echo 'selected';} ?>>Road</option>
                    <option value="Chase" <?php if($row['streetType']== 'chase'){ echo 'selected';} ?>>Chase</option>
                </select>
                <br />
                <label>Suburb<span class="required">*</span>:</label>
                <br />
                <input type="text" name="suburb" value="<?php echo $row['suburb']?>" required />
                <br />
                <label>PostCode<span class="required">*</span>:</label>
                <br />
                <input type="text" name="postcode" value="<?php echo $row['postCode']?>" required />
                <br />
                <label>State<span class="required">*</span>:</label>
                <br />
                <select name="state" >
                    <option value="QLD" <?php if($row['state'] == 'QLD'){echo "selected"; } ?>>QLD</option>
                    <option value="TAS" <?php if($row['state'] == 'TAS'){echo "selected"; } ?>>TAS</option>
                    <option value="NSW" <?php if($row['state'] == 'NSW'){echo "selected"; } ?>>NSW</option>
                    <option value="VIC" <?php if($row['state'] == 'VIC'){echo "selected"; } ?>>VIC</option>
                    <option value="WA" <?php if($row['state'] == 'WA'){echo "selected"; } ?>>WA</option>
                    <option value="NT" <?php if($row['state'] == 'NT'){echo "selected"; } ?>>NT</option>
                    <option value="ACT" <?php if($row['state'] == 'ACT'){echo "selected"; } ?>>ACT</option>
                </select>
                <br />
                <label>Facebook ID</label>
                <br />
                <input type="text" name="facebookID" value="<?php echo $row['facebookId']?>" />
                <br />
                <label>Email<span class="required">*</span>:</label>
                <br />
                <input class="emailInput" type="email" name="email" value="<?php echo $row['email']?>" />
                <br />
                <?php
                    $sql = "SELECT * FROM phonenumbers WHERE userID='$userID'";
                    $result = mysqli_query($con, $sql);
                       $n = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<label>Phone " . $n . "</label><br />";
                        echo "<input type='text' name='phone" . $n . "' value='" . $row['phoneNumber'] . "' /><br />";
                        $n++;
                    }
                       
                    ?>
                <label>Phone <?php echo $n ?></label>
                <br />
                <input type="text" value="" name="phone<?php echo $n?>" />
                <br />
                <input type="hidden" name="numPhones" value="<?php echo $n?>" />
                <label>Parent's Name</label>
                <br />
                <input type="text" name="parentName" value="<?php echo $row['parentName']?>" />
                <br />
                <label>Parent's Email</label>
                <br />
                <input type="text" name="parentEmail" value="<?php echo $row['parentEmail']?>" />
                <br />
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
                <input type="password" name="newPassword2" required  />
                <br />
                <input type="hidden" name="userID" value="<?php echo $userID ?>" />
                <input type="submit" name="changepassword" value="Change Password" /> 
            </form>
        </fieldset>
    </div>