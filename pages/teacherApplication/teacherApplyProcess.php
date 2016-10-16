<?php
    $pagetitle = "Teacher Application";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";
        
    if (!isGuest($_SESSION['accountType']) && !isStudent($_SESSION['accountType'])){
        rejectAccess();
        $_SESSION['success'] = "Only guest users can apply";
    }
?>
<div class="breadcrumb">
    <span><a href="../home/index.php">Home</a> > Teacher Application Submitted</span>
</div>
     <?php
    
    $langauges = $_POST['langauge'];
    $userID = $_SESSION['userID'];
    $instrument = $_POST['instrument'];
    $availability = $_POST['availability'];
    
    //upload file
    $target_dir = "../../applicationUploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileName = $_FILES["fileToUpload"]["name"];
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $alteredName = "$userID.$fileType";
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //save file as userID name with file extension 
        rename ("../../applicationUploads/" . $fileName, "../../applicationUploads/$alteredName");
        echo "<h1>Application submitted! Good luck!</h1>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
    //insert data into db
    $sql = "INSERT INTO applications (userID, language, availability, instrument, fileName) 
    VALUES ('$userID', '$langauges', '$availability', '$instrument', '$alteredName')";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    include "../../inc/footer.php"; 
?>
