<?php
$pagetitle = "Modify Instrument";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>

<div class="content">
<?php
     $schoolInstrumentID = $_GET['schoolInstrumentID'];
    if(isset($_POST['submit'])) {
       
        $instrumentCondition = $_POST['instrumentCondition'];
        $hireCost = $_POST['hireCost'];
        
        $sql = "UPDATE schoolInstruments SET instrumentCondition='$instrumentCondition', hireCost=$hireCost WHERE schoolInstrumentID='$schoolInstrumentID'";
        $result = mysqli_query($con,$sql);
        if($result) {
            $_SESSION['success'] = "Instrument Details Updated.";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['error'] = "An error occured.";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    $sql = "SELECT * FROM schoolinstruments INNER JOIN instrumentnames ON schoolinstruments.instrumentTypeID=instrumentnames.instrumentTypeID WHERE schoolInstrumentID='$schoolInstrumentID'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    
?>
    <a href="adminInstruments.php">Back to Instrument List</a>
    <form method="POST" action="modifyInstrument.php?schoolInstrumentID=<?php echo $schoolInstrumentID ?>">
        <div class="loginForm center-horizontal">
            <h2>Modify Instrument Details</h2>
            <label>Instrument ID:</label><br />
            <input class="form-control" type="text" name="schoolInstrumentID" value="<?php echo $schoolInstrumentID; ?>" readonly /><br />
            <label>Type:</label><br />
            <input class="form-control" type="text" name="instrumentType:" value="<?php echo $row['instrumentName']; ?>" readonly /><br />
            <label>Condition</label><br />
            <select class="form-control" name="instrumentCondition">
                <option value="New" <?php if($row['instrumentCondition'] == 'New'){ echo "selected"; } ?>>New</option>
                <option value="Excellent" <?php if($row['instrumentCondition'] == 'Excellent'){ echo "selected"; } ?>>Excellent</option>
                <option value="Good" <?php if($row['instrumentCondition'] == 'Good'){ echo "selected"; } ?>>Good</option>
                <option value="Repair" <?php if($row['instrumentCondition'] == 'Repair'){ echo "selected"; } ?>>Repair</option>
                <option value="Discard" <?php if($row['instrumentCondition'] == 'Discard'){ echo "selected"; } ?>>Discard</option>
            </select>
            <label>Hire Cost:</label><br />
            <input class="form-control" type="text" value="<?php echo $row['hireCost'] ?>" name="hireCost" /><br />
            
            <input class="form-control" type="submit" value="submit" name="submit" />
        </div>
    
    </form>


</div>

<?php
include "../../inc/footer.php";
?>