<?php
    $pagetitle = "Create Account";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";

    $errorSFirstName = "";
    $errorSLastName = "";
    $errorDoB = "";
    $errorGender = "";
    $errorAddress = "";
    $errorSEmail = "";
    $errorSMobile = "";
    $errorSPhone = "";
    $errorPassword = "";
    $errorConfPassword = "";
    $errorPFirstName = "";
    $errorPLastName = "";
    $errorPEmail = "";
    $errorPMobile = "";
    $errorPPhone = "";
    $errorRelation = "";

    if(isset($_POST['submit'])) {
        if($_POST['sFirstName'] == "") $errorSFirstName = " * required";
        if($_POST['sLastName'] == "") $errorSLastName = " * required";
        if($_POST['dobDay'] == "" || $_POST['dobMonth'] == "" || $_POST['dobYear'] == "") {
            $errorDoB = " * required";
        } else {
            $errorDoB = " Incorrect DoB";
            if (is_numeric($_POST['dobMonth']) && is_numeric($_POST['dobDay']) && is_numeric($_POST['dobYear']))
                if(checkdate((int)$_POST['dobMonth'], (int)$_POST['dobDay'], (int)$_POST['dobDay']))
                    $errorDoB = "";
        }
        if(!isset($_POST['gender'])) $errorGender = " * required";
        // Need to check unit num
        if($_POST['addressNum'] == "" || $_POST['addressStreet'] == "" || $_POST['addressSuburb'] == "" || $_POST['addressState'] == "" || $_POST['addressPostcode'] == "") {
            $errorAddress = " * required";
        } else {
            if (!is_numeric($_POST['addressNum']) || !is_numeric($_POST['addressPostcode']))
                $errorAddress = " Incorrect address";
        }
        if($_POST['sEmail'] == "") $errorSEmail = " * required";
        if($_POST['password'] == "") $errorPassword = " * required";
        if($_POST['confirmPassword'] == "") $errorConfPassword = " * required";

        // Need to check day and month
        if((date("Y") - $_POST['dobYear']) < 18) {
            if($_POST['pFirstName'] == "") $errorPFirstName = " * required";
            if($_POST['pLastName'] == "") $errorPLastName = " * required";
            if($_POST['pEmail'] == "") $errorPEmail = " * required";
            if($_POST['relation'] == "") $errorRelation = " * required";
        }
    } else if(isset($_POST['cancel'])) {
        header("Location: ../pages/index.php");
    }
?>

<div class="content">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h1>Student</h1>
        <table>
            <tr><td>First Name: </td><td><input type="text" required name="sFirstName" value="<?php if(isset($_POST['sFirstName'])) echo($_POST['sFirstName']); ?>"></td><td><?php echo $errorSFirstName ?></td></tr>
            <tr><td>Last Name: </td><td><input type="text" required name="sLastName" value="<?php if(isset($_POST['sLastName'])) echo($_POST['sLastName']); ?>"></td><td><?php echo $errorSLastName ?></td></tr>
            <tr><td>Date of Birth: </td><td>
                <input type="text" name="dobDay" required size="2" maxlength="2" value="<?php if(isset($_POST['dobDay'])) echo($_POST['dobDay']); ?>"> / 
                <input type="text" name="dobMonth" required size="2" maxlength="2" value="<?php if(isset($_POST['dobMonth'])) echo($_POST['dobMonth']); ?>"> / 
                <input type="text" name="dobYear" required size="4" maxlength="4" value="<?php if(isset($_POST['dobYear'])) echo($_POST['dobYear']); ?>"></td><td><?php echo $errorDoB ?></td></tr>

            <tr><td>Gender: </td><td>
                <input type="radio" name="gender" value="female" <?php if(isset($_POST['gender'])) { if($_POST['gender'] == "female") echo("checked"); } ?>>Female
                <input type="radio" name="gender" value="male" <?php if(isset($_POST['gender'])) { if($_POST['gender'] == "male") echo("checked"); } ?>>Male
                </td><td><?php echo $errorGender ?></td></tr>

            <!-- Might need to add in street type textbox -->
            <tr><td>Postal Address: </td><td>
                Unit #: <input type="text" name="addressUnit" size="2" value="<?php if(isset($_POST['addressUnit'])) echo($_POST['addressUnit']); ?>">
                Street #: <input type="text" name="addressNum" required size="3" value="<?php if(isset($_POST['addressNum'])) echo($_POST['addressNum']); ?>"></td></tr>
            <tr><td></td><td>
                Street: <input type="text" name="addressStreet" required value="<?php if(isset($_POST['addressStreet'])) echo($_POST['addressStreet']); ?>"></td><td><?php echo $errorAddress ?></td></tr>
            <tr><td></td><td>
                Suburb: <input type="text" name="addressSuburb" required value="<?php if(isset($_POST['addressSuburb'])) echo($_POST['addressSuburb']); ?>"></td></tr>
            <tr><td></td><td>
                State: <input type="text" name="addressState" required size="3" value="<?php if(isset($_POST['addressState'])) echo($_POST['addressState']); ?>">
                Postcode: <input type="text" name="addressPostcode" required size="4" maxlength="4" value="<?php if(isset($_POST['addressPostcode'])) echo($_POST['addressPostcode']); ?>"></td></tr>

            <tr><td>Email Address: </td><td><input type="text" name="sEmail" required value="<?php if(isset($_POST['sEmail'])) echo($_POST['sEmail']); ?>"></td><td><?php echo $errorSEmail ?></td></tr>
            <!-- Might need to add in area code textbox -->
            <tr><td>Mobile Phone: </td><td><input type="text" name="sMobile" size="10" maxlength="10" value="<?php if(isset($_POST['sMobile'])) echo($_POST['sMobile']); ?>"></td><td><?php echo $errorSMobile ?></td></tr>
            <tr><td>Other Phone: </td><td><input type="text" name="sPhone" size="10" maxlength="10" value="<?php if(isset($_POST['sPhone'])) echo($_POST['sPhone']); ?>"></td><td><?php echo $errorSPhone ?></td></tr>
            <tr><td>Facebook Link: </td><td><input type="text" name="facebook" value="<?php if(isset($_POST['facebook'])) echo($_POST['facebook']); ?>"></td></tr>
            <tr><td>Password: </td><td><input type="password" name="password" required></td><td><?php echo $errorPassword ?></td></tr>
            <tr><td>Confirm Password: </td><td><input type="password" name="confirmPassword" required></td><td><?php echo $errorConfPassword ?></td></tr>
        </table>
        <h2>Parent/ Caregiver</h2>
        <table>
            <tr><td>First Name: </td><td><input type="text" name="pFirstName" value="<?php if(isset($_POST['pFirstName'])) echo($_POST['pFirstName']); ?>"></td><td><?php echo $errorPFirstName ?></td></tr>
            <tr><td>Last Name: </td><td><input type="text" name="pLastName" value="<?php if(isset($_POST['pLastName'])) echo($_POST['pLastName']); ?>"></td><td><?php echo $errorPLastName ?></td></tr>
            <tr><td>Email Address: </td><td><input type="text" name="pEmail" value="<?php if(isset($_POST['pEmail'])) echo($_POST['pEmail']); ?>"></td><td><?php echo $errorPEmail ?></td></tr>
            <tr><td>Mobile Phone: </td><td><input type="text" name="pMobile" size="10" maxlength="10" value="<?php if(isset($_POST['pMobile'])) echo($_POST['pMobile']); ?>"></td></tr>
            <tr><td>Other Phone: </td><td><input type="text" name="pPhone" size="10" maxlength="10" value="<?php if(isset($_POST['pPhone'])) echo($_POST['pPhone']); ?>"></td></tr>
            <tr><td>Relation to student: </td><td><input type="text" name="relation" value="<?php if(isset($_POST['relation'])) echo($_POST['relation']); ?>"></td><td><?php echo $errorRelation ?></td></tr>
        </table>
        <button type="submit" name="submit">Submit</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</div>
<!--end content-->

<?php
    include "../inc/footer.php";
?>