<?php
    $errorAddress = "";
    $errorSEmail = "";
    $errorPhone = "";
    $errorPEmail = "";

    if (isset($_POST['submit'])) {
        $userID = mysqli_real_escape_string($con, $_POST['userID']);
        $firstName = mysqli_real_escape_string($con, $_POST['sFirst']);
        $lastName = mysqli_real_escape_string($con, $_POST['sLast']);
        $DOB = mysqli_real_escape_string($con, $_POST['dob']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $unitNumber = mysqli_real_escape_string($con, $_POST['unitNum']);
        if ($unitNumber == "") {
            $unitNumber = "NULL";
        }
        $streetNumber = mysqli_real_escape_string($con, $_POST['streetNum']);
        $streetName = mysqli_real_escape_string($con, $_POST['street']);
        $streetType = mysqli_real_escape_string($con, $_POST['streetType']);
        $suburb = mysqli_real_escape_string($con, $_POST['suburb']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
        $email = mysqli_real_escape_string($con, $_POST['sEmail']);
        $facebookId = mysqli_real_escape_string($con, $_POST['facebook']);
        if ($facebookId == "") {
            $facebookId = "NULL";
        }
        $parentName = mysqli_real_escape_string($con, $_POST['pName']);
        $parentEmail = mysqli_real_escape_string($con, $_POST['pEmail']);

        // Check student DoB
        $dobDate = date_create($DOB);
        $DOB = date_format($dobDate, "Y-m-d");
        $age = GetAge($DOB);

        // Check unit number
        if ($unitNumber != "NULL") {
            if (!is_numeric($unitNumber)) {
                $errorAddress = "Invalid address";
            }
        }

        // Check address
        if (!is_numeric($streetNumber) || !is_numeric($postcode)) {
            $errorAddress = "Invalid address";
        }

        //Check phone
        /*if ($phone != "") {
            if (!is_numeric($phone) || strlen($phone) != 10) {
                $errorPhone = "Invalid student phone";
            }
        }*/

        if ($errorAddress == "" &&  $errorSEmail == "" && $errorPhone == "" &&  $errorPEmail == "") {
            // Check if email is already in the database
            $sqlCheckEmail = "SELECT email FROM users WHERE userID != '$userID' AND email = '$email'";
            $resultCheckEmail = mysqli_query($con, $sqlCheckEmail) or die(mysqli_error($con));
            $arrayCheckEmail = mysqli_fetch_array($resultCheckEmail);
            
            if (!isset($arrayCheckEmail)) {
                // Get addressID
                $sqlGetAddressID = "SELECT addressID FROM useraddress WHERE userID = '$userID';";
                $resultGetAddressID = mysqli_query($con, $sqlGetAddressID) or die(mysqli_error($con));
                $arrayGetAddressID = mysqli_fetch_array($resultGetAddressID);
                $addressID = $arrayGetAddressID['addressID'];

                // Add phone numbers
                /*if ($phone != "") {
                    $sqlAddPhone = sprintf("INSERT INTO phonenumbers (userID, phoneNumber) VALUES ('%d', '%s');", $userID, $phone);
                    mysqli_query($con, $sqlAddPhone) or die(mysqli_error($con));
                }*/

                // Modify address
                $sqlModifyAddress = "UPDATE address SET unitNumber = $unitNumber, streetNumber = '$streetNumber', streetName = '$streetName', streetType = '$streetType',
                    suburb = '$suburb', state = '$state', postCode = '$postcode' WHERE addressID = '$addressID';";
                mysqli_query($con, $sqlModifyAddress) or die(mysqli_error($con));

                // Modify account
                $sqlModifyUser = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', gender = '$gender', facebookId = $facebookId WHERE UserID = '$userID'";
                mysqli_query($con, $sqlModifyUser) or die(mysqli_error($con));

                // Modify parents
                if ($age < 18) {
                    $sqlModifyParent = "UPDATE users SET parentName = '$parentName', parentEmail = '$parentEmail' WHERE UserID = 'userID';";
                    mysqli_query($con, $sqlModifyParent) or die(mysqli_error($con));
                }
                
                // Login student
                $_SESSION['success'] = "Account Updated";
                header('Location: ../pages/changeAuth.php');
                exit();
            } else {
                $errorSEmail = "Email already in use";
            }
        }
    } else {
        $userID = $_GET['userID'];

        // Get information from the database
        $sqlGetDetails = "SELECT * FROM users INNER JOIN useraddress ON users.UserID=useraddress.userID Inner JOIN address ON useraddress.addressID=address.addressId WHERE users.userid='$userID' ";
        $resultGetDetails = mysqli_query($con, $sqlGetDetails) or die(mysqli_error($con));
        $arrayGetDetails = mysqli_fetch_array($resultGetDetails);

        $firstName = $arrayGetDetails['firstName'];
        $lastName = $arrayGetDetails['lastName'];
        $DOB = $arrayGetDetails['DOB'];
        $gender = $arrayGetDetails['gender'];
        $unitNumber = $arrayGetDetails['unitNumber'];
        $streetNumber = $arrayGetDetails['streetNumber'];
        $streetName = $arrayGetDetails['streetName'];
        $streetType = $arrayGetDetails['streetType'];
        $suburb = $arrayGetDetails['suburb'];
        $state = $arrayGetDetails['state'];
        $postcode = $arrayGetDetails['postCode'];
        $email = $arrayGetDetails['email'];
        $facebookId = $arrayGetDetails['facebookId'];
        $parentName = $arrayGetDetails['parentName'];
        $parentEmail = $arrayGetDetails['parentEmail'];

        $age = GetAge($DOB);
    }

    function GetAge($DOB) {
        $today = new DateTime('now');
        $dob = new DateTime($DOB);
        return date_format($today, "Y") - date_format($dob, "Y");
    }
?>