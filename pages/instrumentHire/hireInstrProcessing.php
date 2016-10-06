<?php
	session_start();
	include "../../inc/connect.php";

	if (isset($_POST['submit'])) {
		$contractID = $_POST['contractID'];
		$schoolInstrumentID = $_POST['submit'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];

		$sqlHireInstr = "INSERT INTO instrumenthire (contractID, schoolInstrumentID, startDate, endDate) VALUES ('$contractID', '$schoolInstrumentID', '$startDate', '$endDate')";
        
        echo $sqlHireInstr;
        
		$resultHireInstr = mysqli_query($con, $sqlHireInstr) or die(mysqli_error($con));
        
        

		$_SESSION['hireSuccess'] = "Instrument hire request has been sent";
		header("location: ../../pages/instrumentHire/instrumenthire.php");
		exit();
	}
?>