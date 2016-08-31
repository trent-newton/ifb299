<?php
    $pagetitle = "Create Account";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";

    $requiredError = "<span class='required'> * required</span>";

    $sFirst = mysqli_real_escape_string($con, $_POST['sFirst']);
    $sLast = mysqli_real_escape_string($con, $_POST['sLast']);
    $dobDay = mysqli_real_escape_string($con, $_POST['dobDay']);
    $dobMonth = mysqli_real_escape_string($con, $_POST['dobMonth']);
    $dobYear = mysqli_real_escape_string($con, $_POST['dobYear']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $unitNum = mysqli_real_escape_string($con, $_POST['unitNum']);
    $streetNum = mysqli_real_escape_string($con, $_POST['streetNum']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $streetType = mysqli_real_escape_string($con, $_POST['streetType']);
    $suburb = mysqli_real_escape_string($con, $_POST['suburb']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
    $sEmail = mysqli_real_escape_string($con, $_POST['sEmail']);
    $sMobile = mysqli_real_escape_string($con, $_POST['sMobile']);
    $sPhone = mysqli_real_escape_string($con, $_POST['sPhone']);
    $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    $pFirst = mysqli_real_escape_string($con, $_POST['pFirst']);
    $pLast = mysqli_real_escape_string($con, $_POST['pLast']);
    $pEmail = mysqli_real_escape_string($con, $_POST['pEmail']);
    $pMobile = mysqli_real_escape_string($con, $_POST['pMobile']);
    $pPhone = mysqli_real_escape_string($con, $_POST['pPhone']);
    $relation = mysqli_real_escape_string($con, $_POST['relation']);

    $errorSFirst = "";
    $errorSLast = "";
    $errorDoB = "";
    $errorGender = "";
    $errorAddress = "";
    $errorSEmail = "";
    $errorSMobile = "";
    $errorSPhone = "";
    $errorPassword = "";
    $errorConfirmPassword = "";
    $errorPFirst = "";
    $errorPLast = "";
    $errorPEmail = "";
    $errorPMobile = "";
    $errorPPhone = "";
    $errorRelation = "";

    if (isset($_POST['submit'])) {
        // Check student first name
        if ($sFirst == "") {
            $errorSFirst = $requiredError;
        }

        // Check student last name
        if ($sLast == "") {
            $errorSLast = $requiredError;
        }

        // Check student DoB
        if ($dobDay == "" || $dobMonth == "" || $dobYear == "") {
            $errorDoB = $requiredError;
        } else {
            $errorDoB = "<div class='required'> Invalid date</div>";
            if (is_numeric($dobDay) && is_numeric($dobMonth) && is_numeric($dobYear)) {
                if (checkdate($dobMonth, $dobDay, $dobYear)) {
                    $errorDoB = "";
                }
            }
        }

        // Check student gender
        if (!isset($gender)) {
            $errorGender = $requiredError;
        }

        // Check unit number
        if ($unitNum != "") {
            if (!is_numeric($unitNum)) {
                $errorAddress = "<div class='required'> Invalid address</div>";
            }
        }

        // Check address
        if ($streetNum == "" || $street == "" || $suburb == "" || $state == "" || $postcode == "") {
            $errorAddress = $requiredError;
        } else {
            if (!is_numeric($streetNum) || !is_numeric($postcode)) {
                $errorAddress = "<div class='required'> Invalid address</div>";
            }
        }

        // Check student email
        if ($sEmail == "") {
            $errorSEmail = $requiredError;
        }

        // Check if there is a student phone number
        if ($sMobile == "" && $sPhone == "") {
            $errorSMobile = "<div class='required'> Phone number required</div>";
        }

        // Check student mobile
        if ($sMobile != "") {
            if (!is_numeric($sMobile) || strlen($sMobile) != 10) {
                $errorSMobile = "<div class='required'> Invalid mobile</div>";
            }
        }

        //Check student phone
        if ($sPhone != "") {
            if (!is_numeric($sPhone) || strlen($sPhone) != 10) {
                $errorSPhone = "<div class='required'> Invalid phone</div>";
            }
        }

        // Check password
        if ($password == "") {
            $errorPassword = $requiredError;
        }

        // Check confirm password
        if ($confirmPassword == "") {
            $errorConfirmPassword = $requiredError;
        } else {
            if ($confirmPassword != $password) {
                $errorConfirmPassword = "<div class='required'> Password did not match</div>";
            } else {
                $salt = md5(uniqid(rand(),true)); // Creates a salt
                $password = hash('sha256', $password.$salt); //Puts the $password and $salt together and hashes it
            }
        }

        // Need to check day and month
        if ((date("Y") - $dobYear) < 18) {
            if ($pFirst == "") {
                $errorPFirst = $requiredError;
            }
            if ($pLast == "") {
                $errorPLast = $requiredError;
            }
            if ($pEmail == "") {
                $errorPEmail = $requiredError;
            }

            if ($relation == "") {
                $errorRelation = $requiredError;
            }

            if ($pMobile == "" && $pPhone == "") {
                $errorPMobile = "<div class='required'> Phone number required</div>";
            }

            if ($pMobile != "") {
                if (!is_numeric($pMobile) || strlen($pMobile) != 10) {
                    $errorPMobile = "<div class='required'> Invalid mobile</div>";
                }
            }

            if ($pPhone != "") {
                if (!is_numeric($pPhone) || strlen($pPhone) != 10) {
                    $errorPPhone = "<div class='required'> Invalid phone</div>";
                }
            }
        }

        if ($errorSFirst == "" && $errorSLast == "" && $errorDoB == "" && $errorGender == "" &&
            $errorAddress == "" && $errorSEmail == "" && $errorSMobile == "" && $errorSPhone == "" &&
            $errorPassword == "" && $errorConfirmPassword == "" && $errorPFirst == "" && $errorPLast == "" &&
            $errorPEmail == "" && $errorPMobile == "" && $errorPPhone == "" && $errorRelation == "") {
            // Get studentID
            $sqlGetStudentID = "SELECT userID FROM users ORDER BY userID DESC LIMIT 1;";
            $resultGetStudentID = mysqli_query($con, $sqlGetStudentID) or die(mysqli_error($con));
            $arrayGetStudentID = mysqli_fetch_array($resultGetStudentID);
            $studentID = $arrayGetStudentID['userID'] + 1;
            // Get addressID
            $sqlGetAddressID = "SELECT AddressID FROM addresses ORDER BY AddressID DESC LIMIT 1;";
            $resultGetAddressID = mysqli_query($con, $sqlGetAddressID) or die(mysqli_error($con));
            $arrayGetAddressID = mysqli_fetch_array($resultGetAddressID);
            $addressID = $arrayGetAddressID['AddressID'] + 1;

            // Insert information into the database
            // Add phone numbers
            $sqlAddPhone = sprintf("INSERT INTO userphonenumbers (userID, phoneNumber) VALUES ('%d', '%d');", $studentID, $sMobile);
            mysqli_query($con, $sqlAddPhone) or die(mysqli_error($con));
            $sqlAddPhone = sprintf("INSERT INTO userphonenumbers (userID, phoneNumber) VALUES ('%d', '%d');", $studentID, $sPhone);
            //mysqli_query($con, $sqlAddPhone) or die(mysqli_error($con));

            // Add student
            $sqlAddUser = sprintf("INSERT INTO users (userID, password, salt, firstName, lastName, gender, birthdate, email, facebookID, accessID)
                VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%d-%d-%d', '%s', '%d', '3');",
                $studentID, $password, $salt, $sFirst, $sLast, $gender, $dobYear, $dobMonth, $dobDay, $sEmail, $facebook);
            mysqli_query($con, $sqlAddUser) or die(mysqli_error($con));

            // Add address
            $sqlAddAddress = sprintf("INSERT INTO addresses (AddressID, unitNumber, streetNumber, streetName, streetType, suburb, state, postcode)
                VALUES ('%d', '%d', '%d', '%s', '%s', '%s', '%s', '%d');",
                $addressID, $unitNum, $streetNum, $street, $streetType, $suburb, $state, $postcode);
            mysqli_query($con, $sqlAddAddress) or die(mysqli_error($con));
            $sqlConnectAddress = sprintf("INSERT INTO useraddresses (userID, addressID) VALUES ('%d', '%d');", $studentID, $addressID);
            mysqli_query($con, $sqlConnectAddress) or die(mysqli_error($con));

            // Add parent
            

        }
    } else if (isset($_POST['cancel'])) {
        header("Location: ../pages/index.php");
    }
?>

<div class="content">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h1>Student</h1>
        <p class="required">* Required Fields</p>
        <label id="lblSFirst" for="txtSFirst">First Name<span class="required">*</span>: </label><input type="text" name="sFirst" id="txtSFirst" placeholder="John" value="<?php if(isset($_POST['sFirst'])) echo($_POST['sFirst']); ?>" required><?php echo "<label>".$errorSFirst."</label>" ?><br>
        <label id="lblSLast" for="txtSLast">Last Name<span class="required">*</span>: </label><input type="text" name="sLast" id="txtSLast" placeholder="Appleseed" value="<?php if(isset($_POST['sLast'])) echo($_POST['sLast']); ?>" required><?php echo "<label>".$errorSLast."</label>" ?><br>
        <label id="lblDob" for="txtDobDay">Date of Birth<span class="required">*</span>: </label>
            <input type="text" name="dobDay" id="txtDobDay" size="2" maxlength="2" placeholder="dd" value="<?php if(isset($_POST['dobDay'])) echo($_POST['dobDay']); ?>" required> / 
            <input type="text" name="dobMonth" id="txtDobMonth" size="2" maxlength="2" placeholder="mm" value="<?php if(isset($_POST['dobMonth'])) echo($_POST['dobMonth']); ?>" required> / 
            <input type="text" name="dobYear" id="txtDobYear" size="4" maxlength="4" placeholder="yyyy" value="<?php if(isset($_POST['dobYear'])) echo($_POST['dobYear']); ?>" required><?php echo "<label>".$errorDoB."</label>" ?><br>
        <label id="lblGender">Gender<span class="required">*</span>: </label>
            <input type="radio" name="gender" value="female" <?php if(isset($_POST['gender'])) { if($_POST['gender'] == "female") echo("checked"); } ?>>Female
            <input type="radio" name="gender" value="male" <?php if(isset($_POST['gender'])) { if($_POST['gender'] == "male") echo("checked"); } ?>>Male
            <?php echo "<label>".$errorGender."</label>" ?><br>
        <br>

        <!-- Might need to add in street type textbox -->
        <label>Postal Address</label><br>
        <label id="lblUnitNum" for="txtUnitNum">Unit #: </label><input type="text" name="unitNum" id="txtUnitNum" size="2" placeholder="4" value="<?php if(isset($_POST['unitNum'])) echo($_POST['unitNum']); ?>">
        <label id="lblStreetNum" for="txtStreetNum">Street #<span class="required">*</span>: </label><input type="text" name="streetNum" id="txtStreetNum" size="3" placeholder="42" value="<?php if(isset($_POST['streetNum'])) echo($_POST['streetNum']); ?>" required><br>
        <label id="lblStreet" for="txtStreet">Street<span class="required">*</span>: </label><input type="text" name="street" id="txtStreet" placeholder="Main" value="<?php if(isset($_POST['street'])) echo($_POST['street']); ?>" required>
            <input type="text" name="streetType" id="txtStreetType" size="10" placeholder="St" value="<?php if(isset($_POST['streetType'])) echo($_POST['streetType']); ?>" required><br>
        <label id="lblSuburb" for="txtSuburb">Suburb<span class="required">*</span>: </label><input type="text" name="suburb" id="txtSuburb" placeholder="Anytown" value="<?php if(isset($_POST['suburb'])) echo($_POST['suburb']); ?>" required><br>
        <label id="lblState" for="txtState">State<span class="required">*</span>: </label><input type="text" name="state" id="txtState" size="3" placeholder="QLD" value="<?php if(isset($_POST['state'])) echo($_POST['state']); ?>" required>
        <label id="lblPostcode" for="txtPostcode">Postcode<span class="required">*</span>: </label><input type="text" name="postcode" id="txtPostcode" size="4" maxlength="4" placeholder="1234" value="<?php if(isset($_POST['postcode'])) echo($_POST['postcode']); ?>" required><?php echo "<label>".$errorAddress."</label>" ?><br>
        <br>

        <label id="lblSEmail" for="txtSEmail">Email Address<span class="required">*</span>: </label><input type="text" name="sEmail" id="txtSEmail" placeholder="student@address.com" value="<?php if(isset($_POST['sEmail'])) echo($_POST['sEmail']); ?>" required><?php echo "<label>".$errorSEmail."</label>" ?><br>
        <!-- Might need to add in area code textbox -->
        <label id="lblSMobile" for="txtSMobile">Mobile Phone: </label><input type="text" name="sMobile" id="txtSMobile" size="10" maxlength="10" placeholder="0412345678" value="<?php if(isset($_POST['sMobile'])) echo($_POST['sMobile']); ?>"><?php echo "<label>".$errorSMobile."</label>" ?><br>
        <label id="lblSPhone" for="txtSPhone">Other Phone: </label><input type="text" name="sPhone" id="txtSPhone" size="10" maxlength="10" placeholder="0787654321" value="<?php if(isset($_POST['sPhone'])) echo($_POST['sPhone']); ?>"><?php echo "<label>".$errorSPhone."</label>" ?><br>
        <label id="lblFacebook" for="txtFacebook">Facebook ID: </label><input type="text" name="facebook" id="txtFacebook" size="40" value="<?php if(isset($_POST['facebook'])) echo($_POST['facebook']); ?>"><br>
        <br>

        <label id="lblPassword" for="txtPassword">Password<span class="required">*</span>: </label><input type="password" name="password" id="txtPassword" required></td><td><?php echo "<label>".$errorPassword."</label>" ?><br>
        <label id="lblConfirmPassword" for="txtConfirmPassword">Confirm Password<span class="required">*</span>: </label><input type="password" name="confirmPassword" id="txtConfirmPassword" required><?php echo "<label>".$errorConfirmPassword."</label>" ?><br>

        <h2>Parent/ Caregiver</h2>
        <p class="required">Only required if student is under the age of 18</p>
        <label id="lblPFirst" for="txtPFirst">First Name<span class="required">*</span>: </label><input type="text" name="pFirst" id="txtPFirst" placeholder="Mary" value="<?php if(isset($_POST['pFirst'])) echo($_POST['pFirst']); ?>"><?php echo "<label>".$errorPFirst."</label>" ?><br>
        <label id="lblPLast" for="txtPLast">Last Name<span class="required">*</span>: </label><input type="text" name="pLast" id="txtPLast" placeholder="Appleseed" value="<?php if(isset($_POST['pLast'])) echo($_POST['pLast']); ?>"><?php echo "<label>".$errorPLast."</label>" ?><br>
        <label id="lblPEmail" for="txtPEmail">Email Address<span class="required">*</span>: </label><input type="text" name="pEmail" id="txtPEmail" placeholder="parent@address.com" value="<?php if(isset($_POST['pEmail'])) echo($_POST['pEmail']); ?>"><?php echo "<label>".$errorPEmail."</label>" ?><br>
        <label id="lblPMobile" for="txtPMobile">Mobile Phone: </label><input type="text" name="pMobile" id="txtPMobile" size="10" maxlength="10" placeholder="0456781234" value="<?php if(isset($_POST['pMobile'])) echo($_POST['pMobile']); ?>"><?php echo "<label>".$errorPMobile."</label>" ?><br>
        <label id="lblPPhone" for="txtPPhone">Other Phone: </label><input type="text" name="pPhone" id="txtPPhone" size="10" maxlength="10" placeholder="0787654321" value="<?php if(isset($_POST['pPhone'])) echo($_POST['pPhone']); ?>"><?php echo "<label>".$errorPPhone."</label>" ?><br>
        <label id="lblRelation" for="txtRelation">Relation to student<span class="required">*</span>: </label><input type="text" name="relation" id="txtRelation" placeholder="Mother" value="<?php if(isset($_POST['relation'])) echo($_POST['relation']); ?>"><?php echo "<label>".$errorRelation."<label>" ?><br>

        <button type="submit" name="submit">Submit</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</div>
<!--end content-->

<?php
    include "../inc/footer.php";
?>