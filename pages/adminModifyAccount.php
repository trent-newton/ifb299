<?php
	$pagetitle = "Change Account Details";
	include "../inc/connect.php";
	include "../inc/header.php";
	include "../inc/nav.php";
    include "../inc/adminupdateaccount.php";
	require "../inc/authCheck.php";

    // Check if user is owner or admin
	if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    	rejectAccess();
	}
?>

<div class="content">
	<fieldset class="accountDetails">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Account details</h1>
            <p class="required">* Required Fields</p>
            <label for="txtSFirst">First Name<span class="required">*</span>: </label>
            <br />
            <input type="text" name="sFirst" id="txtSFirst" placeholder="John" value="<?php echo $firstName ?>" required>
            <br />
            <label for="txtSLast">Last Name<span class="required">*</span>: </label>
            <br />
            <input type="text" name="sLast" id="txtSLast" placeholder="Appleseed" value="<?php echo $lastName ?>" required>
            <br />
            <label for="txtDob">DOB (Read Only): </label>
            <br />
            <input type="date" name="dob" id="txtDob" size="10" maxlength="10" placeholder="yyyy-mm-dd" value="<?php echo $DOB ?>" readonly>
            <br />
            <label>Gender<span class="required">*</span>: </label>
                <input type="radio" name="gender" value="Female" class="inputStreet" <?php if ($gender == "Female") echo "checked";?> required> Female
                <input type="radio" name="gender" value="Male" class="inputStreet" <?php if ($gender == "Male") echo "checked";?> required> Male
            <br><br />
            <label for="txtUnitNum">Unit: </label>
            <input type="text" name="unitNum" id="txtUnitNum" class="inputStreet" size="2" maxlength="4" placeholder="4" value="<?php echo $unitNumber ?>">
            <label for="txtStreetNum">Street No<span class="required">*</span>: </label>
            <input type="text" name="streetNum" class="inputStreet" id="txtStreetNum" size="3" maxlength="4" placeholder="42" value="<?php echo $streetNumber ?>" required>
            <?php echo "<span class='required'>  ".$errorAddress."</span>" ?><br />
            <label or="txtStreet">Street<span class="required">*</span>: </label>
            <br />
            <input type="text" name="street" id="txtStreet" placeholder="Main" value="<?php echo $streetName ?>" required>
                <select name="streetType" id="txtStreetType" required>
                    <option value="street" <?php if($streetType == 'street'){ echo 'selected';} ?>>Street</option>
                    <option value="close" <?php if($streetType == 'close'){echo "selected"; } ?>>Close</option>
                    <option value="road" <?php if($streetType == 'road'){echo "selected"; } ?>>Road</option>
                    <option value="chase" <?php if($streetType == 'chase'){echo "selected"; } ?>>Chase</option>
                </select>
            <br />
            <label for="txtSuburb">Suburb<span class="required">*</span>: </label>
            <br />
            <input type="text" name="suburb" id="txtSuburb" placeholder="Anytown" value="<?php echo $suburb ?>" required>
            <br />
            <label for="txtState">State<span class="required">*</span>:</label>
            <br />
                <select name="state" id="txtState" required>
                    <option value="QLD" <?php if($state == 'QLD'){echo "selected"; } ?>>QLD</option>
                    <option value="NSW" <?php if($state == 'NSW'){echo "selected"; } ?>>NSW</option>
                    <option value="VIC" <?php if($state == 'VIC'){echo "selected"; } ?>>VIC</option>
                    <option value="TAS" <?php if($state == 'TAS'){echo "selected"; } ?>>TAS</option>
                    <option value="WA" <?php if($state == 'WA'){echo "selected"; } ?>>WA</option>
                    <option value="SA" <?php if($state == 'SA'){echo "selected"; } ?>>SA</option>
                    <option value="NT" <?php if($state == 'NT'){echo "selected"; } ?>>NT</option>
                </select>
            <br />
            <label for="txtPostcode">Postcode<span class="required">*</span>: </label>
            <br />
            <input type="text" name="postcode" id="txtPostcode" size="4" maxlength="4" placeholder="1234" value="<?php echo $postcode ?>" required>
            <br><br />
            <label for="txtSEmail">Email<span class="required">*</span>: </label>
            <br />
            <input type="email" name="sEmail" id="txtSEmail" placeholder="student@address.com" value="<?php echo $email ?>" required><?php echo "<span class='required'>  ".$errorSEmail."</span>" ?>
            <br />
            <?php
                echo "<span class='required'>  ".$errorPhone."</span>";

                $sql = "SELECT * FROM phonenumbers WHERE userID='$userID'";
                $result = mysqli_query($con, $sql);
                $n = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($n == 0) {
                        echo "<label for='txtPhone".$n."'>Phone " . $n . "<span class='required'>*</span>:</label><br />";
                        echo "<input type='text' name='phone" . $n . "' id='txtPhone".$n."' size='10' maxlength='10' placeholder='0412345678' value='" . $row['phoneNumber'] . "' required><br />";
                    } else {
                        echo "<label for='txtPhone".$n."'>Phone " . $n . ":</label><br />";
                        echo "<input type='text' name='phone" . $n . "' id='txtPhone".$n."' size='10' maxlength='10' placeholder='0412345678' value='" . $row['phoneNumber'] . "'><br />";
                    }
                    $n++;
                }       
            ?>
            <label for="txtPhone<?php echo $n ?>">Phone <?php echo $n ?>:</label>
            <br />
            <input type="text" name="phone<?php echo $n?>" id="txtPhone<?php echo $n ?>"size='10' maxlength='10' placeholder='0412345678'>
            <br />
            <input type="hidden" name="numPhones" value="<?php echo $n?>" />
            <label for="txtFacebook">Facebook ID: </label>
            <br />
            <input type="text" name="facebook" id="txtFacebook" value="<?php echo $facebookId ?>"><br>
            <?php
                if ($age < 18) {
                    echo '<h2>Parent/ Caregiver</h2>';
                    echo '<label for="txtPName">Name<span class="required">*</span>: </label>';
                    echo '<br />';
                    echo '<input type="text" name="pName" id="txtPName" placeholder="Mary Appleseed" value="'.$parentName.'" required>';
                    echo '<br />';
                    echo '<label for="txtPEmail">Email Address<span class="required">*</span>: </label>';
                    echo '<br />';
                    echo '<input type="email" name="pEmail" id="txtPEmail" placeholder="parent@address.com" value="'.$parentEmail.'" required>';
                    echo '<span class="required">  '.$errorPEmail.'</span>';
                    echo '<br />';
                }
            ?>

            <input type="hidden" name="userID" value="<?php echo $userID?>" />
            <input type="submit" name="submit" value="Submit" />
		</form>
	</fieldset>
</div>
<!-- end content -->

<?php
	include "../inc/footer.php";
?>