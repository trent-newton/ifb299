<?php
    $pagetitle = "Create Account";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
    include "../inc/accountprocessing.php";
?>

<div class="content">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h1>Student</h1>
        <p class="required">* Required Fields</p>
        <label id="lblSFirst" for="txtSFirst">First Name<span class="required">*</span>: </label><input type="text" name="sFirst" id="txtSFirst" placeholder="John" value="<?php if (isset($_POST['sFirst'])) echo $_POST['sFirst'] ?>" required><br>
        <label id="lblSLast" for="txtSLast">Last Name<span class="required">*</span>: </label><input type="text" name="sLast" id="txtSLast" placeholder="Appleseed" value="<?php if (isset($_POST['sLast'])) echo $_POST['sLast'] ?>" required><br>
        <label id="lblDob" for="txtDob">Date of Birth<span class="required">*</span>: </label>
            <input type="date" name="dob" id="txtDob" size="10" maxlength="10" placeholder="yyyy-mm-dd" value="<?php if (isset($_POST['dob'])) echo $_POST['dob'] ?>" required><br>
        <label id="lblGender">Gender<span class="required">*</span>: </label>
            <input type="radio" name="gender" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female") echo "checked";?> required>Female
            <input type="radio" name="gender" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male") echo "checked";?> required>Male
        <br><br>

        <label>Postal Address</label><?php echo "<span class='required'>  ".$errorAddress."</span>" ?><br>
        <label id="lblUnitNum" for="txtUnitNum">Unit #: </label><input type="text" name="unitNum" id="txtUnitNum" size="2" maxlength="4" placeholder="4" value="<?php if (isset($_POST['unitNum'])) echo $_POST['unitNum'] ?>">
        <label id="lblStreetNum" for="txtStreetNum">Street #<span class="required">*</span>: </label><input type="text" name="streetNum" id="txtStreetNum" size="3" maxlength="4" placeholder="42" value="<?php if (isset($_POST['streetNum'])) echo $_POST['streetNum'] ?>" required><br>
        <label id="lblStreet" for="txtStreet">Street<span class="required">*</span>: </label><input type="text" name="street" id="txtStreet" placeholder="Main" value="<?php if (isset($_POST['street'])) echo $_POST['street'] ?>" required>
            <select name="streetType" id="txtStreetType" required>
                <option value="street">Street</option>
                <option value="close">Close</option>
                <option value="road">Road</option>
                <option value="chase">Chase</option>
            </select><br>
        <label id="lblSuburb" for="txtSuburb">Suburb<span class="required">*</span>: </label><input type="text" name="suburb" id="txtSuburb" placeholder="Anytown" value="<?php if (isset($_POST['suburb'])) echo $_POST['suburb'] ?>" required><br>
        <label id="lblState" for="txtState">State<span class="required">*</span>: </label>
            <select name="state" id="txtState" required>
                <option value="QLD">QLD</option>
                <option value="NSW">NSW</option>
                <option value="VIC">VIC</option>
                <option value="TAS">TAS</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="NT">NT</option>
            </select>
        <label id="lblPostcode" for="txtPostcode">Postcode<span class="required">*</span>: </label><input type="text" name="postcode" id="txtPostcode" size="4" maxlength="4" placeholder="1234" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode'] ?>" required><br>
        <br>

        <label id="lblSEmail" for="txtSEmail">Email Address<span class="required">*</span>: </label><input type="email" name="sEmail" id="txtSEmail" placeholder="student@address.com" value="<?php if (isset($_POST['sEmail'])) echo $_POST['sEmail'] ?>" required><?php echo "<span class='required'>  ".$errorSEmail."</span>" ?><br>
        <label id="lblMobile" for="txtMobile">Mobile Phone<span class="required">*</span>: </label><input type="text" name="mobile" id="txtMobile" size="10" maxlength="10" placeholder="0412345678" value="<?php if (isset($_POST['mobile'])) echo $_POST['mobile'] ?>" required><?php echo "<span class='required'>  ".$errorMobile."</span>" ?><br>
        <label id="lblPhone" for="txtPhone">Home Phone: </label><input type="text" name="phone" id="txtPhone" size="10" maxlength="10" placeholder="0787654321" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?>"><?php echo "<span class='required'>  ".$errorPhone."</span>" ?><br>
        <label id="lblFacebook" for="txtFacebook">Facebook ID: </label><input type="text" name="facebook" id="txtFacebook" value="<?php if (isset($_POST['facebook'])) echo $_POST['facebook'] ?>"><br>
        <br>

        <label id="lblPassword" for="txtPassword">Password<span class="required">*</span>: </label><input type="password" name="password" id="txtPassword" required><br>
        <label id="lblConfirmPassword" for="txtConfirmPassword">Confirm Password<span class="required">*</span>: </label><input type="password" name="confirmPassword" id="txtConfirmPassword" required>
        <?php echo "<span class='required'>  ".$errorConfirmPassword."</span>" ?><br>

        <h2>Parent/ Caregiver</h2>
        <p class="required">Only required if student is under the age of 18</p>
        <label id="lblPName" for="txtPName">Name<span class="required">*</span>: </label><input type="text" name="pName" id="txtPNme" placeholder="Mary Appleseed" value="<?php if (isset($_POST['pName'])) echo $_POST['pName'] ?>"><?php echo "<span class='required'>  ".$errorPName."</span>" ?><br>
        <label id="lblPEmail" for="txtPEmail">Email Address<span class="required">*</span>: </label><input type="email" name="pEmail" id="txtPEmail" placeholder="parent@address.com" value="<?php if (isset($_POST['pEmail'])) echo $_POST['pEmail'] ?>"><?php echo "<span class='required'>  ".$errorPEmail."</span>" ?><br>

        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<!--end content-->

<?php
    include "../inc/footer.php";
?>