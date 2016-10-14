<?php
    $pagetitle = "User Management";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";

    if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Administrators can review Teacher Applications .";
        rejectAccess();
    }
?>
    <h2>Review Teacher Applications</h2>
