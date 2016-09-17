<?php
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