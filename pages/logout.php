<?php 
    session_start();
    session_destroy();
    header("location:../pages/index.php"); //redirect to entry page on logout
	exit();
?>