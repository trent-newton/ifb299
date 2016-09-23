<?php
//redirect to home page
function rejectAccess(){
    $_SESSION['error'] = "You don't have authorisation to access this page.";
    header("location:../home/index.php");
    exit();
}

/* Helper functions which help determine access leve of user. */
function isOwner($accountType){
    if ($accountType == 'Owner'){
        return true;
    }
    return false;
}

function isAdmin($accountType){
    if ($accountType == 'Admin'){
        return true;
    }
    return false;
}

function isTeacher($accountType){
    if ($accountType == 'Teacher'){
        return true;
    }
    return false;
}

function isStudentTeacher($accountType){
    if ($accountType == 'StudentAndTeacher'){
        return true;
    }
    return false;
}

function isStudent($accountType){
    if ($accountType == 'Student'){
        return true;
    }
    return false;
}

function isGuest($accountType){
    if ($accountType == 'Guest'){
        return true;
    }
    return false;
}
?>
