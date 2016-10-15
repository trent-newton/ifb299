<?php
    $pagetitle = "User Management";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";
        
    if (!isGuest($_SESSION['accountType']) && !isStudent($_SESSION['accountType'])){
        rejectAccess();
        $_SESSION['success'] = "Only guest users can apply";
    }
    
    $langauges = $_POST['langauge'];
    $userID = $_SESSION['userID'];
    $instrument = $_POST['instrument'];
    $availability = $_POST['availability'];
    
    //upload file
    $target_dir = "../../applicationUploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileName = $_FILES["fileToUpload"]["name"];
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //save file as userID name with file extension 
        rename ("../../applicationUploads/$fileName", "../../applicationUploads/$userID.$fileType");
        echo "<h1>Application submitted! Good luck!</h1>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql = "INSERT INTO applications (userID, language, availability, instrument) 
    VALUES ('$userID', '$langauges', '$availability', '$instrument')";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $_SESSION['success'] = "Application submitted!";

    include "../../inc/footer.php"; 
?>