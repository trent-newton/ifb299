<?php
    $pagetitle = "Create Account";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/checkFunctions.php";
    include "../../inc/accountprocessing.php";
?>

<div class="content centered">
    <?php if(isset($_POST['submit'])) {
        echo '<div class="alert alert-danger">';
        if ($errorDOB != "") echo $errorDOB."<br>";
        if ($errorUnit != "") echo $errorUnit."<br>";
        if ($errorStreet != "") echo $errorStreet."<br>";
        if ($errorPostcode != "") echo $errorPostcode."<br>";
        if ($errorSEmail != "") echo $errorSEmail."<br>";
        if ($errorPhone0 != "") echo $errorPhone0."<br>";
        if ($errorPhone1 != "") echo $errorPhone1."<br>";
        if ($errorConfirmPassword != "") echo $errorConfirmPassword."<br>";
        if ($errorPName != "") echo $errorPName."<br>";
        if ($errorPEmail != "") echo $errorPEmail;
        echo '</div>';
    } ?>

    <fieldset class="accountDetails">
        <form id="accountForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1>Create Account</h1>
            <p class="required">* Required Fields</p>

            <label class="control-label" for="txtSFirst">First Name<span class="required">*</span>: </label>
            <input class="form-control" type="text" name="sFirst" id="txtSFirst" placeholder="John" value="<?php if (isset($_POST['sFirst'])) echo $_POST['sFirst'] ?>" required>

            <label class="control-label" for="txtSLast">Last Name<span class="required">*</span>: </label>
            <input class="form-control" type="text" name="sLast" id="txtSLast" placeholder="Appleseed" value="<?php if (isset($_POST['sLast'])) echo $_POST['sLast'] ?>" required>

            <div class="<?php if ($errorDOB != "") echo 'has-error '; ?>has-feedback">
                <label class="control-label" for="txtDob">DOB<span class="required">*</span>: </label>
                <input class="form-control" type="date" name="dob" id="txtDob" size="10" maxlength="10" placeholder="yyyy-mm-dd" value="<?php if (isset($_POST['dob'])) echo $_POST['dob'] ?>" required>
                <?php if ($errorDOB != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <label id="lblGender">Gender<span class="required">*</span>: </label>
            <div class="radio">
                <label><input type="radio" name="gender" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female") echo "checked";?> required>Female</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="gender" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male") echo "checked";?> required>Male</label>
            </div>

            <br>

            <div class="<?php if ($errorUnit != "") echo 'has-error '; ?>has-feedback">
                <label class="control-label" for="txtUnitNum">Unit No: </label>
                <input class="form-control" type="text" name="unitNum" id="txtUnitNum" size="2" maxlength="4" placeholder="4" value="<?php if (isset($_POST['unitNum'])) echo $_POST['unitNum'] ?>">
                <?php if ($errorUnit != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <div class="<?php if ($errorStreet != "") echo 'has-error '; ?>has-feedback">
                <label class="control-label" for="txtStreetNum">Street No<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="streetNum" id="txtStreetNum" size="3" maxlength="4" placeholder="42" value="<?php if (isset($_POST['streetNum'])) echo $_POST['streetNum'] ?>" required>
                <?php if ($errorStreet != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <label id="lblStreet" for="txtStreet">Street<span class="required">*</span>: </label>
            <input class="form-control" type="text" name="street" id="txtStreet" placeholder="Main" value="<?php if (isset($_POST['street'])) echo $_POST['street'] ?>" required>

            <select class="form-control" name="streetType" id="txtStreetType" required>
                <option value="street" <?php if(isset($_POST['streetType']) && $_POST['streetType'] == 'street'){ echo "selected"; } ?>>Street</option>
                <option value="close" <?php if(isset($_POST['streetType']) && $_POST['streetType'] == 'close'){ echo "selected"; } ?>>Close</option>
                <option value="road" <?php if(isset($_POST['streetType']) && $_POST['streetType'] == 'road'){ echo "selected"; } ?>>Road</option>
                <option value="chase" <?php if(isset($_POST['streetType']) && $_POST['streetType'] == 'chase'){ echo "selected"; } ?>>Chase</option>
            </select>

            <label id="lblSuburb" for="txtSuburb">Suburb<span class="required">*</span>: </label>
            <input class="form-control" type="text" name="suburb" id="txtSuburb" placeholder="Anytown" value="<?php if (isset($_POST['suburb'])) echo $_POST['suburb'] ?>" required>

            <label id="lblState" for="txtState">State<span class="required">*</span>:</label>
            <select class="form-control" name="state" id="txtState" required>
                <option value="QLD" <?php if(isset($_POST['state']) && $_POST['state'] == 'QLD'){ echo "selected"; } ?>>QLD</option>
                <option value="NSW" <?php if(isset($_POST['state']) && $_POST['state'] == 'NSW'){ echo "selected"; } ?>>NSW</option>
                <option value="VIC" <?php if(isset($_POST['state']) && $_POST['state'] == 'VIC'){ echo "selected"; } ?>>VIC</option>
                <option value="TAS" <?php if(isset($_POST['state']) && $_POST['state'] == 'TAS'){ echo "selected"; } ?>>TAS</option>
                <option value="WA" <?php if(isset($_POST['state']) && $_POST['state'] == 'WA'){ echo "selected"; } ?>>WA</option>
                <option value="SA" <?php if(isset($_POST['state']) && $_POST['state'] == 'SA'){ echo "selected"; } ?>>SA</option>
                <option value="NT" <?php if(isset($_POST['state']) && $_POST['state'] == 'NT'){ echo "selected"; } ?>>NT</option>
            </select>

            <div class="<?php if ($errorPostcode != "") echo 'has-error '; ?>has-feedback">
                <label id="lblPostcode" for="txtPostcode">Postcode<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="postcode" id="txtPostcode" size="4" maxlength="4" placeholder="1234" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode'] ?>" required>
                <?php if ($errorPostcode != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <br>

            <div class="<?php if ($errorSEmail != "") echo 'has-error '; ?>has-feedback">
                <label id="lblSEmail" for="txtSEmail">Email<span class="required">*</span>: </label>
                <input class="form-control" type="email" name="sEmail" id="txtSEmail" placeholder="student@address.com" value="<?php if (isset($_POST['sEmail'])) echo $_POST['sEmail'] ?>" required>
                <?php if ($errorSEmail != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <div class="<?php if ($errorPhone0 != "") echo 'has-error '; ?>has-feedback">
                <label id="lblPhone0" for="txtPhone0">Phone 0<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="phone0" id="txtPhone0" size="10" maxlength="10" placeholder="0412345678" value="<?php if (isset($_POST['phone0'])) echo $_POST['phone0'] ?>" required>
                <?php if ($errorPhone0 != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <div class="<?php if ($errorPhone1 != "") echo 'has-error '; ?>has-feedback">
                <label id="lblPhone1" for="txtPhone1">Phone 1: </label>
                <input class="form-control" type="text" name="phone1" id="txtPhone1" size="10" maxlength="10" placeholder="0787654321" value="<?php if (isset($_POST['phone1'])) echo $_POST['phone1'] ?>">
                <?php if ($errorPhone1 != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <label id="lblFacebook" for="txtFacebook">Facebook ID: </label>
            <input class="form-control" type="text" name="facebook" id="txtFacebook" value="<?php if (isset($_POST['facebook'])) echo $_POST['facebook'] ?>">

            <br>

            <label id="lblPassword" for="txtPassword">Password<span class="required">*</span>: </label>
            <input class="form-control" type="password" name="password" id="txtPassword" required />

            <div class="<?php if ($errorConfirmPassword != "") echo 'has-error '; ?>has-feedback">
                <label id="lblConfirmPassword" for="txtConfirmPassword">Confirm Password<span class="required">*</span>: </label>
                <input class="form-control" type="password" name="confirmPassword" id="txtConfirmPassword" required />
                <?php if ($errorConfirmPassword != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <h1>Parent/ Caregiver</h1>
            <p class="required">Only required for prospective students under the age of 18</p>

            <div class="<?php if ($errorPName != "") echo 'has-error '; ?>has-feedback">
                <label id="lblPName" for="txtPName">Name<span class="required">*</span>: </label>
                <input class="form-control" type="text" name="pName" id="txtPName" placeholder="Mary Appleseed" value="<?php if (isset($_POST['pName'])) echo $_POST['pName'] ?>">
                <?php if ($errorPName != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>

            <div class="<?php if ($errorPEmail != "") echo 'has-error '; ?>has-feedback">
                <label id="lblPEmail" for="txtPEmail">Email Address<span class="required">*</span>: </label>
                <input class="form-control" type="email" name="pEmail" id="txtPEmail" placeholder="parent@address.com" value="<?php if (isset($_POST['pEmail'])) echo $_POST['pEmail'] ?>">
                <?php if ($errorPEmail != "") echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
            </div>


            <input class="form-control" type="submit" name="submit" value="Submit" />
        </form>
    </fieldset>
</div>
<!--end content-->

<?php
    include "../../inc/footer.php";
?>
