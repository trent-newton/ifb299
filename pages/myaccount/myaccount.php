<?php
$pagetitle = "My Account";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/logincheck.php";
require "../../inc/checkFunctions.php";

$userID = $_SESSION['userID'];

$sql = "SELECT * FROM users LEFT JOIN useraddress ON users.UserID=useraddress.userID LEFT JOIN address ON useraddress.addressID=address.addressId WHERE users.userID='$userID' ";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

$DOB = StringToDate($row['DOB'], "Y-m-d");
$age = GetAge($DOB);
?>
    <div class="content fieldSetCentered">
        <fieldset class="accountDetails">
            <form method="post" action="../../inc/updateaccount.php">
                <h1>Account details</h1>
                <h3>Personal</h3><h4>

                First Name (Read Only): </h4>
                <input class="form-control" type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly />

                <h4>Last Name (Read Only):
                <input class="form-control" type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly />

                DOB (Read Only):
                <input class="form-control" type="date" value="<?php echo $row['DOB']?>" readonly />

                Gender (Read Only):
                <h5>Male
                <input type="radio" name="gender" class="inputStreet"<?php if($row['gender']=='Male' ) {echo "checked";}?> readonly/>
                Female
                <input type="radio" name="gender" class="inputStreet" <?php if($row['gender']=='Female' ){ echo "checked";}?> readonly />
                </h5>

                <h3>Address</h3><h4>
                Unit:
                <input class="form-control" type="text" name="unitNumber" class="inputStreet" value="<?php echo $row['unitNumber']?>" />

                Street No<span class="required">*</span>:
                <input type="text" name="streetNumber" value="<?php echo $row['streetNumber']?>" class="inputStreet" required />

                <br>
                Street<span class="required">*</span>:

                <input class="form-control" type="text" name="streetName" value="<?php echo $row['streetName']?>" required />

                Street Type<span class="required">*</span>:

                <select class="form-control" name="streetType" required>
                    <option value="Street" <?php if($row['streetType']== 'street'){ echo 'selected';} ?>>Street</option>
                    <option value="Close" <?php if($row['streetType']== 'close'){ echo 'selected';} ?>>Close</option>
                    <option value="Road" <?php if($row['streetType']== 'road'){ echo 'selected';} ?>>Road</option>
                    <option value="Chase" <?php if($row['streetType']== 'chase'){ echo 'selected';} ?>>Chase</option>
                </select>

                Suburb<span class="required">*</span>:

                <input class="form-control" type="text" name="suburb" value="<?php echo $row['suburb']?>" required />

                PostCode<span class="required">*</span>:

                <input class="form-control" type="text" name="postcode" value="<?php echo $row['postCode']?>" required />

                State<span class="required">*</span>:

                <select class="form-control" name="state" >
                    <option value="QLD" <?php if($row['state'] == 'QLD'){echo "selected"; } ?>>QLD</option>
                    <option value="TAS" <?php if($row['state'] == 'TAS'){echo "selected"; } ?>>TAS</option>
                    <option value="NSW" <?php if($row['state'] == 'NSW'){echo "selected"; } ?>>NSW</option>
                    <option value="VIC" <?php if($row['state'] == 'VIC'){echo "selected"; } ?>>VIC</option>
                    <option value="WA" <?php if($row['state'] == 'WA'){echo "selected"; } ?>>WA</option>
                    <option value="NT" <?php if($row['state'] == 'NT'){echo "selected"; } ?>>NT</option>
                    <option value="ACT" <?php if($row['state'] == 'ACT'){echo "selected"; } ?>>ACT</option>
                </select>
                <h3>Contact Info</h3><h4>
                Facebook ID

                <input class="form-control" type="text" name="facebookID" value="<?php echo $row['facebookId']?>" />

                Email<span class="required">*</span>:

                <input class="form-control" class="emailInput" type="email" name="email" value="<?php echo $row['email']?>" />
                <?php
                    $sqlPhone = "SELECT * FROM phonenumbers WHERE userID='$userID'";
                    $resultPhone = mysqli_query($con, $sqlPhone);
                       $n = 0;
                    while ($rowPhone = mysqli_fetch_array($resultPhone)) {
                        echo "  Phone " . $n . "";
                        echo "<input class='form-control' type='text' name='phone" . $n . "' value='" . $rowPhone['phoneNumber'] . "' />";
                        $n++;
                    }

                    ?>
                Phone <?php echo $n ?>
                <input class='form-control' type="text" value="" name="phone<?php echo $n?>" />
                <input class='form-control' type="hidden" name="numPhones" value="<?php echo $n?>" />
                <?php
                    if ($age < 18) {
                        echo "<h3>Parent Info</h3><h4>";
                        echo "Parent's Name<span class='required'>*</span>: ";
                        echo "<input class='form-control' type='text' name='parentName' value='".$row['parentName']."' required>";
                        echo "Parent's Email<span class='required'>*</span>: ";
                        echo "<input class='form-control' type='email' name='parentEmail' value='".$row['parentEmail']."' required>";
                    }
                ?>
                <input class='form-control' type="hidden" name="userID" value="<?php echo $userID?>" />
                <br><input class='form-control' type="submit" name="accountupdate" value="Update Details" />
            </form>
        </fieldset>
        <fieldset class="changePassword">
            <form method="post" action="inc/changepassword.php">
                <h2>Change Password</h2>
                Current Password:
                <br />
                <input class='form-control' type="password" name="oldPassword" required />
                <br />
                New Password:
                <br />
                <input class='form-control' type="password" name="newPassword" required />
                <br />
                New Password Again:
                <br />
                <input class='form-control' type="password" name="newPassword2" required  />
                <br />
                <input class='form-control' type="hidden" name="userID" value="<?php echo $userID ?>" />
                <input class='form-control' type="submit" name="changepassword" value="Change Password" />
            </form>
        </fieldset>
    </div>
<?php
include "../../inc/footer.php";
?>
