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
        $streetNumber = mysqli_real_escape_string($con, $_POST['streetNum']);
        $streetName = mysqli_real_escape_string($con, $_POST['street']);
        $streetType = mysqli_real_escape_string($con, $_POST['streetType']);
        $suburb = mysqli_real_escape_string($con, $_POST['suburb']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
        $email = mysqli_real_escape_string($con, $_POST['sEmail']);
        for ($i = 0; $i <= $_POST['numPhones']; $i++) {
            ${"phoneNumber".$i} = mysqli_real_escape_string($con, $_POST['phone'.$i]);
        }
        $facebookId = mysqli_real_escape_string($con, $_POST['facebook']);
        $parentName = mysqli_real_escape_string($con, $_POST['pName']);
        $parentEmail = mysqli_real_escape_string($con, $_POST['pEmail']);

        // Check student DoB
        $DOB = StringToDate($DOB, "Y-m-d");
        $age = GetAge($DOB);

        // Check unit number
        if ($unitNumber != "") {
            if (!is_numeric($unitNumber)) {
                $errorAddress = "Invalid address";
            }
        }

        // Check address
        if (!is_numeric($streetNumber) || !is_numeric($postcode)) {
            $errorAddress = "Invalid address";
        }

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

                // Modify phone numbers
                $sql = "SELECT * FROM phonenumbers WHERE userID='$userID'";
                $result = mysqli_query($con, $sql);
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $phoneNo = $row['phoneNumber'];
                    if (${"phoneNumber".$i} != "") {
                        $phUpdate = "UPDATE phonenumbers SET phoneNumber='" . ${"phoneNumber".$i} .  "' WHERE phoneNumber='$phoneNo' AND userID='$userID'";
                    } else {
                        $phUpdate = "DELETE FROM phonenumbers WHERE phoneNumber='$phoneNo' AND userID='$userID'";
                    }
                    $runPhUpdate = mysqli_query($con, $phUpdate);
                    $i++;
                }
                if(${"phoneNumber".$i} != "") {
                    $phone = ${"phoneNumber".$i};
                    echo $phone;
                    $sql = "INSERT INTO phonenumbers VALUES ('$userID', '$phone')";
                    $result = mysqli_query($con, $sql);
                }

                // Modify address
                if ($unitNumber == "") {
                    $unitNumber = "NULL";
                }
                $sqlModifyAddress = "UPDATE address SET unitNumber = $unitNumber, streetNumber = '$streetNumber', streetName = '$streetName', streetType = '$streetType',
                    suburb = '$suburb', state = '$state', postCode = '$postcode' WHERE addressID = '$addressID'";
                mysqli_query($con, $sqlModifyAddress) or die(mysqli_error($con));

                // Modify account
                if ($facebookId == "") {
                    $facebookId = "NULL";
                }
                $sqlModifyUser = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', gender = '$gender', facebookId = $facebookId WHERE UserID = '$userID'";
                mysqli_query($con, $sqlModifyUser) or die(mysqli_error($con));

                // Modify parents
                if ($age < 18) {
                    $sqlModifyParent = "UPDATE users SET parentName = '$parentName', parentEmail = '$parentEmail' WHERE UserID = '$userID'";
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
        $sqlGetDetails = "SELECT * FROM users LEFT JOIN useraddress ON users.UserID=useraddress.userID LEFT JOIN address ON useraddress.addressID=address.addressId WHERE users.userID='$userID'";
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
?>