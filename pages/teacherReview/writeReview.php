<?php
// Get selected contractID
$contractID = $_GET['contractID'];
$pagetitle = "Review Contract $contractID";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";
include "../../inc/reviewprocessing.php";

if(!isStudent($_SESSION['accountType']) && !isStudentTeacher($_SESSION['accountType']) && !isTeacher($_SESSION['accountType'])){
    rejectAccess();
}
?>

 <div class="content">
    <h1 class="centered">Review of
      <?php
      //Finds contract and finds the related teacher name and instrument used in contract
      $sql2 = "SELECT contracts.*, users.firstName, users.lastName, instrumentnames.instrumentName FROM users INNER JOIN contracts ON users.userID=contracts.teacherID LEFT JOIN instrumentnames ON contracts.instrumentTypeID = instrumentnames.instrumentTypeID WHERE contracts.contractID = $contractID";
      $result2 = mysqli_query($con, $sql2);
      while ($row = mysqli_fetch_array($result2)) {
        echo $row["firstName"];
        echo " ";
        echo $row["lastName"];
        echo "</h1>";
?>
        <div class="reviewLessonForm">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label id="lblPComment" for="txtPComment">Comment<span class="required">*</span>: </label>

            <textarea class="form-control" type="comment" rows="5" name="comment" id="txtComment" value="<?php if (isset($_POST['comment'])) echo $_POST['comment'] ?>"></textarea>
                <?php echo "<span class='required'>  ".$errorComment."</span>" ?>

                <label id="lblStars" for="txtStars">Star Rating<span class="required">*</span>:</label>

                <select class='form-control' name="stars" id="txtStar" required>
                        <option value="5" <?php if(isset($_POST['stars']) && $_POST['stars']== '5'){echo "selected"; } ?>>5</option>
                        <option value="4" <?php if(isset($_POST['stars']) && $_POST['stars']== '4'){echo "selected"; } ?>>4</option>
                        <option value="3" <?php if(isset($_POST['stars']) && $_POST['stars']== '3'){echo "selected"; } ?>>3</option>
                        <option value="2" <?php if(isset($_POST['stars']) && $_POST['stars']== '2'){echo "selected"; } ?>>2</option>
                        <option value="1" <?php if(isset($_POST['stars']) && $_POST['stars']== '1'){echo "selected"; } ?>>1</option>
                </select>
                <br>
                <?php
                  $contractID = $row['contractID'];
                  $teacherID = $row['teacherID'];
                  $studentID = $row['studentID'];

                //Pass other key information to reviewprocessing.php
                echo '<input type="hidden" value="' .$contractID. '" name="contractID" />
                <input type="hidden" value="' .$teacherID. '" name="teacherID" />
                <input type="hidden" value="' .$studentID. '" name="studentID" />';
                ?>

            <input class="form-control"type="submit" name="submit" value="Submit" />

          </form>

        </div>

<?php
        echo "<div class='lessonReviewInfoBox'><h3>Instrument Played: </h3>" .$row["instrumentName"];
        echo "<h3>Start of Contract: </h3>" .$row["startDate"];
        echo "<h3>End of Contract: </h3>" .$row["endDate"];
        echo "</div>";
      }
      ?>


</div>

<?php
include "../../inc/footer.php";
?>
