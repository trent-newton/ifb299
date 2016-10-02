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
    $instrumentTypeID = $_POST['instrumentID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sqlGetInstruments = "SELECT * FROM schoolinstruments
                            LEFT JOIN instrumenthire ON schoolinstruments.instrumentID=instrumenthire.schoolInstrumentID
                            INNER JOIN instrumentnames ON schoolinstruments.instrumentTypeID=instrumentnames.instrumentTypeID
                            WHERE schoolinstruments.instrumentTypeID=$instrumentTypeID";
    $resultGetInstruments = mysqli_query($con, $sqlGetInstruments) or die(mysqli_error($con));
?>

<div class="content centered">
    <a href='../../pages/instrumentHire/instrumentHire.php'>Return to instrument hire page</a>
    <br><br>

    <form method="post" action="<?php echo htmlspecialchars("../../pages/instrumenthire/hireInstrProcessing.php") ?>">
        <input type="hidden" name="contractID" value="<?php echo $contractID ?>" />
        <input type="hidden" name="instrumentID" value="<?php echo $instrumentID ?>" />
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
                            if ($startDate>=$row['endDate'] || $endDate<=$row['startDate']) {
                                $entries++;
                                echo "<tr><td>".$row['instrumentID']."</td>";
                                echo "<td>".$row['instrumentName']."</td>";
                                echo "<td>".$row['instrumentCondition']."</td>";
                                echo "<td>$".$row['hireCost']."</td>";
                                echo "<td><input class='form-control' type='submit' name='submit' value=".$row['instrumentID']." /></td></tr>";
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