<?php
	include "../../inc/connect.php";

	$contractID = intval($_GET['q']);

	$sqlGetContracts = "SELECT * FROM contracts LEFT JOIN instrumentnames ON instrumentnames.instrumentTypeID=contracts.instrumentTypeID WHERE contractID='$contractID'";
	$resultGetContracts = mysqli_query($con, $sqlGetContracts) or die(mysqli_error($con));
	while($row = mysqli_fetch_array($resultGetContracts)) {
		echo "<br>";
        $instrumentTypeID = $row['instrumentTypeID'];
        echo "Instrument: ".$row['instrumentName']."<br />";
        $day = $row['day'];
        echo "Day of class: ".$day."<br />";
        $time = $row['time'];
        echo "Class time: ".$time."<br />";
        echo "Contract start date: ".$row['startDate']."<br />";
        echo "Contract end date: ".$row['endDate']."<br /><br />";
    }
?>

<form method="post" action="<?php echo htmlspecialchars("../../pages/instrumentHire/chooseInstrument.php") ?>">
    <input type="hidden" name="contractID" value="<?php echo $contractID ?>" />
    <input type="hidden" name="instrumentTypeID" value="<?php echo $instrumentTypeID ?>" />
    <input type="hidden" name="day" value="<?php echo $day ?>" />
    <input type="hidden" name="time" value="<?php echo $time ?>" />
    <label for="selectStartDate">Hire start date<span class="required">*</span>: </label>
    <select class="form-control" name="startDate" id="selectStartDate" required></select>
    <label for="selectEndDate">Hire end date<span class="required">*</span>: </label>
    <select class="form-control" name="endDate" id="selectEndDate" required></select>
    <input class="form-control" type="submit" name="submit" value="Submit" />
</form>