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
    $userID = $_SESSION['userID'];
    $availability = $_POST['availability'];

    //store all instruments in variable
    if (!isset($_POST['check_list'])){
        $_SESSION['error'] = "Please select atleast one instrument";
        header("location:" . $_SERVER["HTTP_REFERER"]);
        exit();
    } else {
        foreach($_POST['check_list'] as $check) {
            $instrumentlist .= $check;
        }
    }

    //store all languages in variable
    foreach($_POST['check_language'] as $check) {
        $languagelist .= $check;
    }

    //set directory, set file as userID and get file extension 
    $target_dir = "../../applicationUploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileName = $_FILES["fileToUpload"]["name"];
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $alteredName = "$userID.$fileType";
    
    //only allow pdf files
    if($fileType != "pdf") { 
        $_SESSION['error'] = "Sorry, only PDFs are allowed.";
        header("location:" . $_SERVER["HTTP_REFERER"]);
        exit();
    } else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //save file as userID name with file extension 
        rename ("../../applicationUploads/" . $fileName, "../../applicationUploads/$alteredName");
        
        //insert data into db
        $sql = "INSERT INTO applications (userID, language, availability, instrument, fileName) 
        VALUES ('$userID', '$languagelist', '$availability', '$instrumentlist', '$alteredName')";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        echo "<h1>Application submitted! Good luck!</h1>";
       
    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file. Please try again.";
        header("location:" . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    include "../../inc/footer.php"; 
?>
