<?php
session_start();
include "../inc/connect.php";
?>

<?php
$userID = $_POST['userID'];

$sql = "SELECT * FROM `users` INNER JOIN useraddress ON users.UserID=useraddress.userID Inner JOIN address ON useraddress.addressID=address.addressId WHERE users.userid='$userID'";

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

if($email == "") {
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
    $Sresult = mysqli_query($con, $sql);
        
    $_SESSION['success'] = "Account Updated";
    header("location:" . $_SERVER["HTTP_REFERER"]);
    exit();
}