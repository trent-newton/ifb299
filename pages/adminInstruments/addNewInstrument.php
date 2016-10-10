<?php
$pagetitle = "New School Instrument";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
if(isset($_POST['submit'])) {
    $condition = $_POST['condition'];
    $hireCost = $_POST['hireCost'];
    $instrumentTypeID = $_POST['instrumentTypeID'];
    
    $sql = "INSERT INTO schoolInstruments (instrumentTypeID, instrumentCondition, hireCost ) VALUES ('$instrumentTypeID', '$condition', '$hireCost')";
    echo $sql;
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    if($result) {
        $_SESSION['success'] = "Instrument Added";
        header("location:adminInstruments.php");
        exit();
    } else {
        $_SESSION['error'] = "An error occured.";
        header("location:adminInstruments.php");
        exit();
    }
}
?>
<div class="content">
    <h2>Add a  New School Instrument</h2>
    
    <form method="POST" action="addNewInstrument.php">
        <label>Instrument Type</label><br />
        <select class="form-control" name="instrumentTypeID">
            <?php
                $sql = "SELECT * FROM instrumentNames";
                $result = mysqli_query($con, $sql);
                while($row=mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['instrumentTypeID'] . "'>" . $row['instrumentName'] . "</option>";
                }
            ?>
        </select>
        <label>Condition</label>
        <select class="form-control" name="condition">
            <option value="Please Select..." disabled selected>Please Select...</option>
            <option value="New">New</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Repair">Repair</option>
            <option value="Discard">Discard</option>
        </select>
        <label>Hire Cost</label><br />
        <input type="text" name="hireCost" /><br /><br />
        <input class="form-control" type="submit" name="submit" value="Add Instrument" />
        
    </form>
</div>


<?php
include "../../inc/footer.php";
?>