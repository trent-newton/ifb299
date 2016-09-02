<?php
    session_start();
    include "../inc/connect.php";

    $errorDoB = "";
    $errorAddress = "";
    $errorSPhone = "";
    $errorConfirmPassword = "";
    $errorPFirst = "";
    $errorPLast = "";
    $errorPGender = "";
    $errorPEmail = "";
    $errorPPhone = "";
    $errorRelation = "";

    $sFirst = mysqli_real_escape_string($con, $_POST['sFirst']);
    $sLast = mysqli_real_escape_string($con, $_POST['sLast']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $sGender = mysqli_real_escape_string($con, $_POST['sGender']);
    $unitNum = mysqli_real_escape_string($con, $_POST['unitNum']);
    $streetNum = mysqli_real_escape_string($con, $_POST['streetNum']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $streetType = mysqli_real_escape_string($con, $_POST['streetType']);
    $suburb = mysqli_real_escape_string($con, $_POST['suburb']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
    $sEmail = mysqli_real_escape_string($con, $_POST['sEmail']);
    $sPhone = mysqli_real_escape_string($con, $_POST['sPhone']);
    $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    $pFirst = mysqli_real_escape_string($con, $_POST['pFirst']);
    $pLast = mysqli_real_escape_string($con, $_POST['pLast']);
    $pGender = mysqli_real_escape_string($con, $_POST['pGender']);
    $pEmail = mysqli_real_escape_string($con, $_POST['pEmail']);
    $pPhone = mysqli_real_escape_string($con, $_POST['pPhone']);
    $relation = mysqli_real_escape_string($con, $_POST['relation']);

    // Check student DoB
    $dobDate = date_create($dob);
    $dob = date_format($dobDate, "Y-m-d");

    // Check unit number
    if ($unitNum != "") {
        if (!is_numeric($unitNum)) {
            $errorAddress = "Invalid address";
        }
    }

    // Check address
    if (!is_numeric($streetNum) || !is_numeric($postcode)) {
        $errorAddress = "Invalid address";
    }

    //Check student phone
    if (!is_numeric($sPhone) || strlen($sPhone) != 10) {
        $errorSPhone = "Invalid student phone";
    }

    // Check confirm password
    if ($confirmPassword != $password) {
        $errorConfirmPassword = "Password did not match";
    } else {
        $salt = md5(uniqid(rand(),true)); // Creates a salt
        $password = hash('sha256', $password.$salt); //Puts the $password and $salt together and hashes it
    }

    // Need to check day and month
    $today = new DateTime('now');
    if ((date_format($today, "Y") - date_format($dobDate, "Y")) < 18) {
        if ($pFirst == "") {
            $errorPFirst = "Parent first name required";
        }

        if ($pLast == "") {
            $errorPLast = "Parent last name required";
        }

        if(!isset($pGender)) {
            $errorPGender = "Parent gender required";
        }

        if ($pEmail == "") {
            $errorPEmail = "Parent email required";
        }

        if ($relation == "") {
            $errorRelation = "Parent relationship required";
        }

        if ($pPhone != "") {
            if (!is_numeric($pPhone) || strlen($pPhone) != 10) {
                $errorPPhone = "Invalid parent phone";
            }
        }
    }

    if ($errorDoB == "" && $errorAddress == "" && $errorSPhone == "" && $errorConfirmPassword == "" && $errorPFirst == "" && $errorPLast == "" && $errorPGender == "" && $errorPEmail == "" && $errorPPhone == "" && $errorRelation == "") {
        // Get studentID
        $sqlGetStudentID = "SELECT UserID FROM users ORDER BY UserID DESC LIMIT 1;";
        $resultGetStudentID = mysqli_query($con, $sqlGetStudentID) or die(mysqli_error($con));
        $arrayGetStudentID = mysqli_fetch_array($resultGetStudentID);
        $studentID = $arrayGetStudentID['UserID'] + 1;
        // Get addressID
        $sqlGetAddressID = "SELECT addressId FROM address ORDER BY addressId DESC LIMIT 1;";
        $resultGetAddressID = mysqli_query($con, $sqlGetAddressID) or die(mysqli_error($con));
        $arrayGetAddressID = mysqli_fetch_array($resultGetAddressID);
        $addressID = $arrayGetAddressID['addressId'] + 1;

        ////////
        // Add student
        ////////

        // Add phone numbers
        $sqlAddPhone = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $studentID, $sPhone);
        mysqli_query($con, $sqlAddPhone) or die(mysqli_error($con));

        // Add address
        $sqlAddAddress = sprintf("INSERT INTO address (addressId, unitNumber, streetNumber, streetName, streetType, suburb, state, postCode)
            VALUES ('%d', '%d', '%d', '%s', '%s', '%s', '%s', '%d');",
            $addressID, $unitNum, $streetNum, $street, $streetType, $suburb, $state, $postcode);
        mysqli_query($con, $sqlAddAddress) or die(mysqli_error($con));
        $sqlConnectAddress = sprintf("INSERT INTO useraddress (userID, addressID) VALUES ('%d', '%d');", $studentID, $addressID);
        mysqli_query($con, $sqlConnectAddress) or die(mysqli_error($con));

        // Add student
        $sqlAddUser = sprintf("INSERT INTO users (UserID, password, salt, firstName, lastName, gender, DOB, email, facebookId, accountType)
            VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '3');",
            $studentID, $password, $salt, $sFirst, $sLast, $sGender, $dob, $sEmail, $facebook);
        mysqli_query($con, $sqlAddUser) or die(mysqli_error($con));

        ////////
        // Add parent
        ////////

        $parentID = $studentID + 1;

        // Add phone numbers
        $sqlAddPhone = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $parentID, $pPhone);
        mysqli_query($con, $sqlAddPhone) or die(mysqli_error($con));

        // Add address
        $sqlConnectAddress = sprintf("INSERT INTO useraddress (userID, addressID) VALUES ('%d', '%d');", $parentID, $addressID);
        mysqli_query($con, $sqlConnectAddress) or die(mysqli_error($con));

        // Add parent
        $sqlAddUser = sprintf("INSERT INTO users (UserID, password, salt, firstName, lastName, gender, DOB, email, accountType)
            VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '2');",
            $parentID, $password, $salt, $pFirst, $pLast, $pGender, $dob, $pEmail);
        mysqli_query($con, $sqlAddUser) or die(mysqli_error($con));

        // Get parentStudentID
        $sqlGetPSID = "SELECT studentParentID FROM studentparent ORDER BY studentParentID DESC LIMIT 1;";
        $resultGetPSID = mysqli_query($con, $sqlGetPSID) or die(mysqli_error($con));
        $arrayGetPSID = mysqli_fetch_array($resultGetPSID);
        $PSID = $arrayGetPSID['studentParentID'] + 1;

        // Add student - parent
        $sqlAddPS = sprintf("INSERT INTO studentparent (studentParentID, studentID, parentID) VALUES ('%d', '%d', '%d');", $PSID, $studentID, $parentID);
        mysqli_query($con, $sqlAddPS) or die(mysqli_error($con));
        
        // Login student
        $_SESSION['userID'] = $studentID;
        $_SESSION['accountType'] = 3;
        $_SESSION['success'] = "Welcome back " .ucfirst($sFirst) . " "  . ucfirst($sLast);
        header("location:../pages/index.php");
        exit();
    } else {
        $_SESSION['error'] = sprintf("%s, %s, %s, %s, %s, %s, %s, %s, %s", $errorDoB, $errorAddress, $errorSPhone, $errorConfirmPassword, $errorPFirst, $errorPLast, $errorPGender, $errorPEmail, $errorPPhone, $errorRelation);
        header("location:../pages/index.php");
        exit();
    }
?>