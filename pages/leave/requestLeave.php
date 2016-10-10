<?php
// Get selected contractID
$contractID = $_GET['contractID'];
$pagetitle = "Request for Leave";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";
include "../../inc/leaverequestprocessing.php";

//allows access to teachers or students
if(!isStudent($_SESSION['accountType']) && !isStudentTeacher($_SESSION['accountType']) && !isTeacher($_SESSION['accountType'])){
    rejectAccess();
}
?>

<h2>Request Leave</h2>
<div class="reviewLessonForm">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label id="lblStartDate" for="txtStartDate">Start Date<span class="required">*</span>:</label>

    <select name="startDate" id="txtStartDate" required>
            <option value="5" <?php if(isset($_POST['startDate']) && $_POST['startDate']== '2016-08-01'){echo "selected"; } ?>>2016-08-01</option>
            <option value="4" <?php if(isset($_POST['startDate']) && $_POST['startDate']== '2016-08-02'){echo "selected"; } ?>>2016-08-02</option>
            <option value="3" <?php if(isset($_POST['startDate']) && $_POST['startDate']== '2016-08-03'){echo "selected"; } ?>>2016-08-03</option>
            <option value="2" <?php if(isset($_POST['startDate']) && $_POST['startDate']== '2016-08-04'){echo "selected"; } ?>>2016-08-04</option>
            <option value="1" <?php if(isset($_POST['startDate']) && $_POST['startDate']== '2016-08-05'){echo "selected"; } ?>>2016-08-05</option>
    </select>

    <label id="lblEndDate" for="txtEndDate">End Date<span class="required">*</span>:</label>

    <select name="endDate" id="txtEndDate" required>
            <option value="5" <?php if(isset($_POST['endDate']) && $_POST['endDate']== '2016-08-01'){echo "selected"; } ?>>2016-08-01</option>
            <option value="4" <?php if(isset($_POST['endDate']) && $_POST['endDate']== '2016-08-02'){echo "selected"; } ?>>2016-08-02</option>
            <option value="3" <?php if(isset($_POST['endDate']) && $_POST['endDate']== '2016-08-03'){echo "selected"; } ?>>2016-08-03</option>
            <option value="2" <?php if(isset($_POST['endDate']) && $_POST['endDate']== '2016-08-04'){echo "selected"; } ?>>2016-08-04</option>
            <option value="1" <?php if(isset($_POST['endDate']) && $_POST['endDate']== '2016-08-05'){echo "selected"; } ?>>2016-08-05</option>
    </select>
    <br/>
    <label id="lblReason" for="txtReason">Reason<span class="required">*</span>: </label>
    <textarea class="form-control" type="reason" rows="5" name="reason" id="txtReason" value="<?php if (isset($_POST['comment'])) echo $_POST['reason'] ?>"></textarea>
        <?php echo "<span class='required'>  ".$errorComment."</span>" ?>


        <?php

          $userID = $row['userID'];

        //Pass other key information to reviewprocessing.php
        echo '<input type="hidden" value="' .$userID. '" name="userID" />';
        ?>

    <input class="form-control"type="submit" name="submit" value="Submit" />

  </form>

</div>

<?php
include "../../inc/footer.php";
?>
