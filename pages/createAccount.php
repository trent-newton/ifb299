<?php
    $pagetitle = "Create Account";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
?>

<div class="content">
    <form method="post" action="../inc/accountprocessing.php">
        <h1>Student</h1>
        <p class="required">* Required Fields</p>
        <label id="lblSFirst" for="txtSFirst">First Name<span class="required">*</span>: </label><input type="text" name="sFirst" id="txtSFirst" placeholder="John" required><br>
        <label id="lblSLast" for="txtSLast">Last Name<span class="required">*</span>: </label><input type="text" name="sLast" id="txtSLast" placeholder="Appleseed" required><br>
        <label id="lblDob" for="txtDob">Date of Birth<span class="required">*</span>: </label>
            <input type="date" name="dob" id="txtDob" size="10" maxlength="10" placeholder="yyyy-mm-dd" required><br>
        <label id="lblSGender">Gender<span class="required">*</span>: </label>
            <input type="radio" name="sGender" value="Female" required>Female
            <input type="radio" name="sGender" value="Male" required>Male
        <br><br>

        <label>Postal Address</label><br>
        <label id="lblUnitNum" for="txtUnitNum">Unit #: </label><input type="text" name="unitNum" id="txtUnitNum" size="2" maxlength="4" placeholder="4">
        <label id="lblStreetNum" for="txtStreetNum">Street #<span class="required">*</span>: </label><input type="text" name="streetNum" id="txtStreetNum" size="3" maxlength="4" placeholder="42" required><br>
        <label id="lblStreet" for="txtStreet">Street<span class="required">*</span>: </label><input type="text" name="street" id="txtStreet" placeholder="Main" required>
            <select name="streetType" id="txtStreetType" required>
                <option value="street">Street</option>
                <option value="close">Close</option>
                <option value="road">Road</option>
                <option value="chase">Chase</option>
            </select><br>
        <label id="lblSuburb" for="txtSuburb">Suburb<span class="required">*</span>: </label><input type="text" name="suburb" id="txtSuburb" placeholder="Anytown" required><br>
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
        <label id="lblPostcode" for="txtPostcode">Postcode<span class="required">*</span>: </label><input type="text" name="postcode" id="txtPostcode" size="4" maxlength="4" placeholder="1234" required><br>
        <br>

        <label id="lblSEmail" for="txtSEmail">Email Address<span class="required">*</span>: </label><input type="email" name="sEmail" id="txtSEmail" placeholder="student@address.com" required><br>
        <label id="lblSPhone" for="txtSPhone">Contact Phone<span class="required">*</span>: </label><input type="text" name="sPhone" id="txtSPhone" size="10" maxlength="10" placeholder="0412345678" required><br>
        <label id="lblFacebook" for="txtFacebook">Facebook ID: </label><input type="text" name="facebook" id="txtFacebook"><br>
        <br>

        <label id="lblPassword" for="txtPassword">Password<span class="required">*</span>: </label><input type="password" name="password" id="txtPassword" required><br>
        <label id="lblConfirmPassword" for="txtConfirmPassword">Confirm Password<span class="required">*</span>: </label><input type="password" name="confirmPassword" id="txtConfirmPassword" required><br>

        <h2>Parent/ Caregiver</h2>
        <p class="required">Only required if student is under the age of 18</p>
        <label id="lblPFirst" for="txtPFirst">First Name<span class="required">*</span>: </label><input type="text" name="pFirst" id="txtPFirst" placeholder="Mary"><br>
        <label id="lblPLast" for="txtPLast">Last Name<span class="required">*</span>: </label><input type="text" name="pLast" id="txtPLast" placeholder="Appleseed"><br>
        <label id="lblPGender">Gender<span class="required">*</span>: </label>
            <input type="radio" name="pGender" value="Female">Female
            <input type="radio" name="pGender" value="Male">Male
        <br>
        <label id="lblPEmail" for="txtPEmail">Email Address<span class="required">*</span>: </label><input type="email" name="pEmail" id="txtPEmail" placeholder="parent@address.com"><br>
        <label id="lblPPhone" for="txtPPhone">Contact Phone<span class="required">*</span>: </label><input type="text" name="pPhone" id="txtPPhone" size="10" maxlength="10" placeholder="0456781234"><br>
        <label id="lblRelation" for="txtRelation">Relation to student<span class="required">*</span>: </label><input type="text" name="relation" id="txtRelation" placeholder="Mother"><br>

        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<!--end content-->

<?php
    include "../inc/footer.php";
?>