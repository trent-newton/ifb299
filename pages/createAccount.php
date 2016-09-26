<?php
    $pagetitle = "Create Account";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
    require "../inc/checkFunctions.php";
    include "../inc/accountprocessing.php";
?>

<div class="content">
    <fieldset class="accountDetails">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1>Student</h1>
            <p class="required">* Required Fields</p>
            <label id="lblSFirst" for="txtSFirst">First Name<span class="required">*</span>: </label>
            <br />
            <input type="text" name="sFirst" id="txtSFirst" placeholder="John" value="<?php if (isset($_POST['sFirst'])) echo $_POST['sFirst'] ?>" required>
            <br />
            <label id="lblSLast" for="txtSLast">Last Name<span class="required">*</span>: </label>
            <br />
            <input type="text" name="sLast" id="txtSLast" placeholder="Appleseed" value="<?php if (isset($_POST['sLast'])) echo $_POST['sLast'] ?>" required>
            <br />
            <label id="lblDob" for="txtDob">DOB<span class="required">*</span>: </label>
            <br />
            <input type="date" name="dob" id="txtDob" size="10" maxlength="10" placeholder="yyyy-mm-dd" value="<?php if (isset($_POST['dob'])) echo $_POST['dob'] ?>" required>
                <?php echo "<span class='required'>  ".$errorDOB."</span>" ?>
            <br />
            <label id="lblGender">Gender<span class="required">*</span>: </label>
                <input type="radio" name="gender" value="Female" class="inputStreet" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female") echo "checked";?> required> Female
                <input type="radio" name="gender" value="Male" class="inputStreet"<?php if (isset($_POST['gender']) && $_POST['gender'] == "Male") echo "checked";?> required> Male
            <br />

            <h2>Postal Address</h2>
            <label id="lblUnitNum" for="txtUnitNum">Unit: </label>
            <input class="inputStreet" type="text" name="unitNum" id="txtUnitNum" size="2" maxlength="4" placeholder="4" value="<?php if (isset($_POST['unitNum'])) echo $_POST['unitNum'] ?>">
            <label id="lblStreetNum" for="txtStreetNum">Street No<span class="required">*</span>: </label>
            <input type="text" class="inputStreet" name="streetNum" id="txtStreetNum" size="3" maxlength="4" placeholder="42" value="<?php if (isset($_POST['streetNum'])) echo $_POST['streetNum'] ?>" required>
                <?php echo "<span class='required'>  ".$errorStreet."</span>" ?>
            <br />
            <label id="lblStreet" for="txtStreet">Street<span class="required">*</span>: </label>
            <br />
            <input type="text" name="street" id="txtStreet" placeholder="Main" value="<?php if (isset($_POST['street'])) echo $_POST['street'] ?>" required>
                <select name="streetType" id="txtStreetType" required>
                    <option value="street" <?php if(isset($_POST['streetType']) && $_POST['streetType']== 'street'){echo "selected"; } ?>>Street</option>
                    <option value="close" <?php if(isset($_POST['streetType']) && $_POST['streetType']== 'close'){echo "selected"; } ?>>Close</option>
                    <option value="road" <?php if(isset($_POST['streetType']) && $_POST['streetType']== 'road'){echo "selected"; } ?>>Road</option>
                    <option value="chase" <?php if(isset($_POST['streetType']) && $_POST['streetType']== 'chase'){echo "selected"; } ?>>Chase</option>
                </select>
            <br />
            <label id="lblSuburb" for="txtSuburb">Suburb<span class="required">*</span>: </label>
            <br />
            <input type="text" name="suburb" id="txtSuburb" placeholder="Anytown" value="<?php if (isset($_POST['suburb'])) echo $_POST['suburb'] ?>" required>
            <br />
            <label id="lblState" for="txtState">State<span class="required">*</span>:</label>
            <br />
                <select name="state" id="txtState" required>
                    <option value="QLD" <?php if(isset($_POST['state']) && $_POST['state']== 'QLD'){echo "selected"; } ?>>QLD</option>
                    <option value="NSW" <?php if(isset($_POST['state']) && $_POST['state']== 'NSW'){echo "selected"; } ?>>NSW</option>
                    <option value="VIC" <?php if(isset($_POST['state']) && $_POST['state']== 'VIC'){echo "selected"; } ?>>VIC</option>
                    <option value="TAS" <?php if(isset($_POST['state']) && $_POST['state']== 'TAS'){echo "selected"; } ?>>TAS</option>
                    <option value="WA" <?php if(isset($_POST['state']) && $_POST['state']== 'WA'){echo "selected"; } ?>>WA</option>
                    <option value="SA" <?php if(isset($_POST['state']) && $_POST['state']== 'SA'){echo "selected"; } ?>>SA</option>
                    <option value="NT" <?php if(isset($_POST['state']) && $_POST['state']== 'NT'){echo "selected"; } ?>>NT</option>
                </select>
            <br />
            <label id="lblPostcode" for="txtPostcode">Postcode<span class="required">*</span>: </label>
            <br />
            <input type="text" name="postcode" id="txtPostcode" size="4" maxlength="4" placeholder="1234" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode'] ?>" required>
                <?php echo "<span class='required'>  ".$errorPostcode."</span>" ?>
            <br />

            <label id="lblSEmail" for="txtSEmail">Email<span class="required">*</span>: </label>
            <br />
            <input type="email" name="sEmail" id="txtSEmail" placeholder="student@address.com" value="<?php if (isset($_POST['sEmail'])) echo $_POST['sEmail'] ?>" required>
                <?php echo "<span class='required'>  ".$errorSEmail."</span>" ?>
            <br />
            <label id="lblPhone0" for="txtPhone0">Phone 0<span class="required">*</span>: </label>
            <br />
            <input type="text" name="phone0" id="txtPhone0" size="10" maxlength="10" placeholder="0412345678" value="<?php if (isset($_POST['phone0'])) echo $_POST['phone0'] ?>" required>
                <?php echo "<span class='required'>  ".$errorPhone0."</span>" ?>
            <br />
            <label id="lblPhone1" for="txtPhone1">Phone 1: </label>
            <br />
            <input type="text" name="phone1" id="txtPhone1" size="10" maxlength="10" placeholder="0787654321" value="<?php if (isset($_POST['phone1'])) echo $_POST['phone1'] ?>">
                <?php echo "<span class='required'>  ".$errorPhone1."</span>" ?>
            <br />
            <label id="lblFacebook" for="txtFacebook">Facebook ID: </label>
            <br />
            <input type="text" name="facebook" id="txtFacebook" value="<?php if (isset($_POST['facebook'])) echo $_POST['facebook'] ?>"><br>
            <br />
            <label id="lblPassword" for="txtPassword">Password<span class="required">*</span>: </label>
            <br />
            <input type="password" name="password" id="txtPassword" required>
            <br />
            <label id="lblConfirmPassword" for="txtConfirmPassword">Confirm Password<span class="required">*</span>: </label>
            <br />
            <input type="password" name="confirmPassword" id="txtConfirmPassword" required>
                <?php echo "<span class='required'>  ".$errorConfirmPassword."</span>" ?>
            <br />

            <h2>Parent/ Caregiver</h2>
            <p class="required">Only required if student is under the age of 18</p>
            <label id="lblPName" for="txtPName">Name<span class="required">*</span>: </label>
            <br />
            <input type="text" name="pName" id="txtPName" placeholder="Mary Appleseed" value="<?php if (isset($_POST['pName'])) echo $_POST['pName'] ?>">
                <?php echo "<span class='required'>  ".$errorPName."</span>" ?>
            <br />
            <label id="lblPEmail" for="txtPEmail">Email Address<span class="required">*</span>: </label>
            <br />
            <input type="email" name="pEmail" id="txtPEmail" placeholder="parent@address.com" value="<?php if (isset($_POST['pEmail'])) echo $_POST['pEmail'] ?>">
                <?php echo "<span class='required'>  ".$errorPEmail."</span>" ?>
            <br />

            <input type="submit" name="submit" value="Submit" />
        </form>
    </fieldset>
</div>
<!--end content-->

<?php
    include "../inc/footer.php";
?>
