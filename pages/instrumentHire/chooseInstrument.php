<?php
$pagetitle = "Instrument Hire";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType']))) {
    $_SESSION['error'] = "Only Students can access this page.";
    rejectAccess();
}

$contractID = $_POST['contractID'];
$instrumentTypeID = $_POST['instrumentTypeID'];
$day = $_POST['day'];
$time = $_POST['time'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$sqlGetCurrentHires = "SELECT schoolInstrumentID, instrumenthire.startDate, instrumenthire.endDate, contracts.time, contracts.day FROM instrumenthire
INNER JOIN contracts ON instrumenthire.contractID=contracts.contractID
WHERE contracts.instrumentTypeID=$instrumentTypeID";
$resultGetCurrentHires = mysqli_query($con, $sqlGetCurrentHires) or die(mysqli_error($con));

$incorrectInstr = [];

while ($row = mysqli_fetch_array($resultGetCurrentHires)) {
    if (!in_array($row['schoolInstrumentID'], $incorrectInstr)) {
        if ($startDate<=$row['endDate'] && $endDate>=$row['startDate'] && $time == $row['time'] && $day == $row['day']) {
            array_push($incorrectInstr, $row['schoolInstrumentID']);
        }
    } 
}

$sqlGetInstruments = "SELECT * FROM schoolinstruments
INNER JOIN instrumentnames ON schoolinstruments.instrumentTypeID=instrumentnames.instrumentTypeID
WHERE schoolinstruments.instrumentTypeID=$instrumentTypeID";
$resultGetInstruments = mysqli_query($con, $sqlGetInstruments) or die(mysqli_error($con));
?>
<div class="content">
    <div class="breadcrumb">
        <span><a href="../home/index.php">Home</a> > <a href="../usercenter/usercenter.php">User Center</a> > Hire an Instrument</span>
    </div>

    <form method="post" action="<?php echo htmlspecialchars("../../pages/instrumenthire/hireInstrProcessing.php") ?>">
        <input type="hidden" name="contractID" value="<?php echo $contractID ?>" />
        <input type="hidden" name="instrumentTypeID" value="<?php echo $instrumentTypeID ?>" />
        <input type="hidden" name="startDate" value="<?php echo $startDate ?>" />
        <input type="hidden" name="endDate" value="<?php echo $endDate ?>" />

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Condition</th>
                    <th>Hire Cost</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $entries = 0;
                    while ($row = mysqli_fetch_array($resultGetInstruments)) {
                        if (!in_array($row['schoolInstrumentID'], $incorrectInstr)) {
                            $entries++;
                            echo "<tr><td>".$row['schoolInstrumentID']."</td>";
                            echo "<td>".$row['instrumentName']."</td>";
                            echo "<td>".$row['instrumentCondition']."</td>";
                            echo "<td>$".$row['hireCost']."</td>";
                            //echo "<td><input class='form-control' type='submit' name='submit' value=".$row['schoolInstrumentID']." /></td></tr>";
                            echo "<td><button class='form-control' type='submit' name='submit' value=".$row['schoolInstrumentID'].">Hire Instrument</button></td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>

    <?php if ($entries == 0) {
        echo "<div class='alert alert-danger'>No instruments available for hire</div>";
    } ?>
</div>

<?php include "../../inc/footer.php"; ?>