<?php

    $errorComment = "";

    if (isset($_POST['submit'])) {
        $stars = mysqli_real_escape_string($con, $_POST['stars']);
        $comment = mysqli_real_escape_string($con, $_POST['comment']);
        $contractID = mysqli_real_escape_string($con, $_POST['contractID']);
        $teacherID = mysqli_real_escape_string($con, $_POST['teacherID']);
        $studentID = mysqli_real_escape_string($con, $_POST['studentID']);
        $dateNow = date('Y-m-d');

                $sql = sprintf("INSERT INTO teacherreviews (teacherID, studentID, contractID, reviewComment, reviewRating, reviewDate, reviewStatus) VALUES ('%d', '%d', '%d','%s', '%d', '%s', '%s');",
                $teacherID, $studentID, $contractID, $comment, $stars, $dateNow, "Pending");
                mysqli_query($con, $sql) or die(mysqli_error($con));
                $_SESSION['success'] = "Review Addded.";
                header("location:../home/index.php");
                exit();
        } else {
            $_SESSION['error'] = "Please review field errors";
        }
?>
