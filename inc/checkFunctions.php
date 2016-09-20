<?php
	function SendError($errorMessage) {
		$_SESSION['error'] = $errorMessage;
        header("location:" . $_SERVER["HTTP_REFERER"]);
        exit();
	}

	function CheckEmail($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email";
        } else {
        	return "";
        }
	}

	function CheckNumeric($inputString, $error) {
		if (!is_numeric($inputString)) {
			return $error;
		} else {
			return "";
		}
	}

	function CheckNumAndLength($inputString, $requiredLength, $error) {
		$numError = CheckNumeric($inputString, $error);

		if ($numError != "" || strlen($inputString) != $requiredLength) {
            return $error;
        } else {
        	return "";
        }
	}

	function CheckDateString($stringDate) {
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $stringDate)) {
        	return "Invalid date";
    	} else {
    		return "";
    	}
	}

	function StringToDate($stringDate, $dateFormat) {
		$dobDate = date_create($stringDate);
		return date_format($dobDate, $dateFormat);
	}

    function GetAge($DOB) {
        $today = new DateTime('now');
        $dob = new DateTime($DOB);
        return date_format($today, "Y") - date_format($dob, "Y");
    }
?>