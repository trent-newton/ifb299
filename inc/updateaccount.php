<?php
session_start();
include "../inc/connect.php";
?>

<?php
$userID = $_POST['userID'];
$numPhones = $_POST['numPhones'];

$sql = "SELECT * FROM users INNER JOIN useraddress ON users.UserID=useraddress.userID Inner JOIN address ON useraddress.addressID=address.addressId WHERE users.userid='$userID'";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$addressID = $row['addressID'];

    
    
$facebookID = mysqli_real_escape_string($con,$_POST['facebookID']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$parentName = mysqli_real_escape_string($con,$_POST['parentName']);
$parentEmail = mysqli_real_escape_string($con,$_POST['parentEmail']);
$unitNo = mysqli_real_escape_string($con,$_POST['unitNumber']);
$streetNumber = mysqli_real_escape_string($con,$_POST['streetNumber']);
$streetName = mysqli_real_escape_string($con,$_POST['streetName']);
$streetType = mysqli_real_escape_string($con,$_POST['streetType']);
$suburb = mysqli_real_escape_string($con,$_POST['suburb']);
$postcode = mysqli_real_escape_string($con,$_POST['postcode']);
$state = mysqli_real_escape_string($con,$_POST['state']);

for($i = 0; $i <= $numPhones; $i++) {
    ${"phoneNumber".$i} = mysqli_real_escape_string($con, $_POST['phone'.$i]);
}



if($email == "" || $streetNumber == "" || $streetName == "" || $streetType == "" || $suburb == "" || $postcode == "" || $state == "" ) {
    $_SESSION['error'] = "All * fields are required.";
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit();
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) || ($parentEmail != "" && !filter_var($parentEmail, FILTER_VALIDATE_EMAIL))) {
    $_SESSION['error'] = "Please enter a valid email and Parent Email";
    header("location:" . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    $sql = "Update users SET email='$email', facebookId='$facebookID', parentName='$parentName', parentEmail='$parentEmail' WHERE userID='$userID'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    $sql = "UPDATE address SET unitNumber='$unitNo', streetNumber='$streetNumber', streetName='$streetName', streetType='$streetType', suburb='$suburb', postCode='$postcode' WHERE addressId='$addressID'";
    $result = mysqli_query($con, $sql);
    
    $sql = "SELECT * FROM phonenumbers WHERE userID='$userID'";
    $result = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $phoneNo = $row['phoneNumber'];
        $phUpdate = "UPDATE phonenumbers SET phoneNumber='" . ${"phoneNumber".$i} .  "' WHERE phoneNumber='" . $phoneNo .  "' AND userID='$userID'";
        $runPhUpdate = mysqli_query($con, $phUpdate);
        $i++;
    }
    if(${"phoneNumber".$i} != "") {
        $phone = ${"phoneNumber".$i};
        $sql = "INSERT INTO phonenumbers VALUES ('$userID', '$phone')";
        $result = mysqli_query($con, $sql);
    }
        
    $_SESSION['success'] = "Account Updated";
    header("location:" . $_SERVER["HTTP_REFERER"]);
    exit();
}

