<?php

    $errorComment = "";

    if (isset($_POST['submit'])) {
        $reason = mysqli_real_escape_string($con, $_POST['reason']);
        $startDate = mysqli_real_escape_string($con, $_POST['startDate']);
        $endDate = mysqli_real_escape_string($con, $_POST['endDate']);
        $userID = mysqli_real_escape_string($con, $_POST['userID']);
        $dateNow = date('Y-m-d');

                $sql = sprintf("INSERT INTO leaverequests (userID, reason, startDate, endDate, requestDate, status) VALUES ('%d', '%s', '%s','%s', '%s', '%s');",
                $userID, $reason, $startDate, $endDate, $dateNow, "Pending");
                mysqli_query($con, $sql) or die(mysqli_error($con));

                $_SESSION['success'] = "Leave Request Submitted";
                header("location:../home/index.php");
                exit();
        } else {
            $_SESSION['error'] = "Please review field errors";
        }
?>
