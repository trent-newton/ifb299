<?php
    $errorAddress = "";
    $errorMobile = "";
    $errorPhone = "";
    $errorConfirmPassword = "";
    $errorPName = "";
    $errorPEmail = "";

    if (isset($_POST['submit'])) {
        $sFirst = mysqli_real_escape_string($con, $_POST['sFirst']);
        $sLast = mysqli_real_escape_string($con, $_POST['sLast']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $unitNum = mysqli_real_escape_string($con, $_POST['unitNum']);
        $streetNum = mysqli_real_escape_string($con, $_POST['streetNum']);
        $street = mysqli_real_escape_string($con, $_POST['street']);
        $streetType = mysqli_real_escape_string($con, $_POST['streetType']);
        $suburb = mysqli_real_escape_string($con, $_POST['suburb']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
        $sEmail = mysqli_real_escape_string($con, $_POST['sEmail']);
        $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
        $pName = mysqli_real_escape_string($con, $_POST['pName']);
        $pEmail = mysqli_real_escape_string($con, $_POST['pEmail']);

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

        //Check student mobile
        if (!is_numeric($mobile) || strlen($mobile) != 10) {
            $errorMobile = "Invalid student mobile";
        }

        //Check student phone
        if ($phone != "") {
            if (!is_numeric($phone) || strlen($phone) != 10) {
                $errorPhone = "Invalid student phone";
            }
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
            if ($pName == "") {
                $errorPName = "Parent name required";
            }

            if ($pEmail == "") {
                $errorPEmail = "Parent email required";
            }
        }

        if ($errorAddress == "" && $errorPhone == "" && $errorMobile == "" && $errorConfirmPassword == "" && $errorPName == "" && $errorPEmail == "") {
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

            // Add mobile numbers
            $sqlAddMobile = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $studentID, $mobile);
            mysqli_query($con, $sqlAddMobile) or die(mysqli_error($con));

            // Add phone numbers
            if ($phone != "") {
                $sqlAddPhone = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $studentID, $phone);
                mysqli_query($con, $sqlAddPhone) or die(mysqli_error($con));
            }

            // Add address
            $sqlAddAddress = sprintf("INSERT INTO address (addressId, streetNumber, streetName, streetType, suburb, state, postCode)
                VALUES ('%d', '%d', '%s', '%s', '%s', '%s', '%d');",
                $addressID, $streetNum, $street, $streetType, $suburb, $state, $postcode);
            mysqli_query($con, $sqlAddAddress) or die(mysqli_error($con));
            if ($unitNum != "") {
                $sqlAddUnitNum = sprintf("UPDATE address SET unitNumber = '%d' WHERE addressID = '%d';", $unitNum, $addressID);
                mysqli_query($con, $sqlAddUnitNum) or die(mysqli_error($con));
            }
            $sqlConnectAddress = sprintf("INSERT INTO useraddress (userID, addressID) VALUES ('%d', '%d');", $studentID, $addressID);
            mysqli_query($con, $sqlConnectAddress) or die(mysqli_error($con));

            // Add student
            $sqlAddUser = sprintf("INSERT INTO users (UserID, password, salt, firstName, lastName, gender, DOB, email)
                VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", $studentID, $password, $salt, $sFirst, $sLast, $gender, $dob, $sEmail);
            mysqli_query($con, $sqlAddUser) or die(mysqli_error($con));
            if ($facebook != "") {
                $sqlAddFacebook = sprintf("UPDATE users SET facebookId = '%d' WHERE UserID = '%d';", $facebook, $studentID);
                mysqli_query($con, $sqlAddFacebook) or die(mysqli_error($con));
            }
            if ((date_format($today, "Y") - date_format($dobDate, "Y")) < 18) {
                $sqlAddParent = sprintf("UPDATE users SET parentName = '%s', parentEmail = '%s' WHERE UserID = '%d';", $pName, $pEmail, $studentID);
                mysqli_query($con, $sqlAddParent) or die(mysqli_error($con));
            }
            
            // Login student
            $_SESSION['userID'] = $studentID;
            $_SESSION['accountType'] = 3;
            $_SESSION['success'] = "Welcome back " .ucfirst($sFirst) . " "  . ucfirst($sLast);
            header("location:../pages/index.php");
            exit();
        }
    }
?>