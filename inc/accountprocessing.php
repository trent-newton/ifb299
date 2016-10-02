<?php
    $errorDOB = "";
    $errorUnit = "";
    $errorStreet = "";
    $errorPostcode = "";
    $errorSEmail = "";
    $errorPhone0 = "";
    $errorPhone1 = "";
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
        $phone0 = mysqli_real_escape_string($con, $_POST['phone0']);
        $phone1 = mysqli_real_escape_string($con, $_POST['phone1']);
        $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
        $pName = mysqli_real_escape_string($con, $_POST['pName']);
        $pEmail = mysqli_real_escape_string($con, $_POST['pEmail']);

        // Check student DoB and parent's details
        $errorDOB = CheckDateString($dob);
        if ($errorDOB == "") {
            $dob = StringToDate($dob, "Y-m-d");

            // Need to check day and month
            $age = GetAge($dob);
            if ($age < 18) {
                if ($pName == "") {
                    $errorPName = "Parent name required";
                }

                if ($pEmail == "") {
                    $errorPEmail = "Parent email required";
                } else {
                    $errorPEmail = CheckEmail($pEmail);
                }
            }
        }

        // Check student email
        $errorSEmail = CheckEmail($sEmail);

        // Check unit number
        if ($unitNum != "") {
            $errorUnit = CheckNumeric($unitNum, "Invalid unit number");
        }

        // Check street number
        $errorStreet = CheckNumeric($streetNum, "Invalid street number");

        // Check postcode
        $errorPostcode = CheckNumAndLength($postcode, 4, "Invalid postcode");

        //Check student phone0
        $errorPhone0 = CheckNumAndLength($phone0, 10, "Invalid phone number");

        //Check student phone1
        if ($phone1 != "") {
            $errorPhone1 = CheckNumAndLength($phone1, 10, "Invalid phone number");
        }

        // Check confirm password
        if ($confirmPassword != $password) {
            $errorConfirmPassword = "Password did not match";
        } else {
            $salt = md5(uniqid(rand(),true)); // Creates a salt
            $password = hash('sha256', $password.$salt); //Puts the $password and $salt together and hashes it
        }

        if ($errorDOB == "" && $errorUnit == "" && $errorStreet == "" && $errorPostcode == "" && $errorPhone0 == "" && $errorPhone1 == "" && $errorConfirmPassword == "" && $errorPName == "" && $errorPEmail == "") {
            // Check if email is already in the database
            $sqlCheckEmail = sprintf("SELECT email FROM users WHERE email='%s'", $sEmail);
            $resultCheckEmail = mysqli_query($con, $sqlCheckEmail) or die(mysqli_error($con));
            $arrayCheckEmail = mysqli_fetch_array($resultCheckEmail);

            if (!isset($arrayCheckEmail)) {
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

                // Add phone0 numbers
                $sqlAddPhone0 = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $studentID, $phone0);
                mysqli_query($con, $sqlAddPhone0) or die(mysqli_error($con));

                // Add phone1 numbers
                if ($phone1 != "") {
                    $sqlAddPhone1 = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $studentID, $phone1);
                    mysqli_query($con, $sqlAddPhone1) or die(mysqli_error($con));
                }

                // Add address
                $sqlAddAddress = sprintf("INSERT INTO address (addressId, streetNumber, streetName, streetType, suburb, state, postCode)
                    VALUES ('%d', '%d', '%s', '%s', '%s', '%s', '%d');",
                    $addressID, $streetNum, $street, $streetType, $suburb, $state, $postcode);
                mysqli_query($con, $sqlAddAddress) or die(mysqli_error($con));
                // Update unit number
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
                // Update facebook
                if ($facebook != "") {
                    $sqlAddFacebook = sprintf("UPDATE users SET facebookId = '%d' WHERE UserID = '%d';", $facebook, $studentID);
                    mysqli_query($con, $sqlAddFacebook) or die(mysqli_error($con));
                }
                // Update parents
                if ($age < 18) {
                    $sqlAddParent = sprintf("UPDATE users SET parentName = '%s', parentEmail = '%s' WHERE UserID = '%d';", $pName, $pEmail, $studentID);
                    mysqli_query($con, $sqlAddParent) or die(mysqli_error($con));
                }

                // Login student
                $_SESSION['userID'] = $studentID;
                $_SESSION['accountType'] = 3;
                $_SESSION['success'] = "Welcome back " .ucfirst($sFirst) . " "  . ucfirst($sLast);
                header("location:../../pages/home/index.php");
                exit();
            } else {
                $errorSEmail = "Student email is already in use";
            }
        }
    }
?>
