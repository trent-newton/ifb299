<?php
include "../../inc/connect.php";

echo "<div class='form-content'>";

$columnInstrument  = array(
  'instrumentName' => 'instrumentName'
);

$columnLanguage  = array(
  'language' => 'language'
);

//query to find list of instruments
$resultInstrument = mysqli_query($con,"SELECT distinct instrumentName FROM instrumentNames");

//query to find list of langauges
$resultLanguage = mysqli_query($con,"SELECT distinct language FROM languages");

if($_SESSION['accountType'] == 'Admin')
{
  echo '<br><form method="post" class="form-inline" action="enrolClassTimes.php?userID='.$_GET['userID'].'">';
} else {
  echo '<br><form method="post" class="form-inline" action="enrolClassTimes.php">';
}
echo '<div class="row">';
  echo '<div class="col-md-2">';
    //select instrument
    echo '<select class="form-control" required name="chosenInstrument">
      <option value="" disabled selected> Select Instrument </option>';

      while($row = mysqli_fetch_array($resultInstrument)) {
          foreach ($columnInstrument as $name => $col_name) {
            echo "<option value='$row[$col_name]'";
            if(isset($_POST['chosenInstrument']) && $_POST['chosenInstrument'] == "$row[$col_name]"){
                echo "selected";
            }
            echo ">$row[$col_name]</option>";
          }
      }
    echo '</select></div>';
echo '<div class="col-md-2">';
    //select language
    echo '<select class="form-control" required name="chosenLanguage">
      <option value="" disabled selected> Select Language </option>';
        while($row = mysqli_fetch_array($resultLanguage)) {
          foreach ($columnLanguage as $name => $col_name) {
            echo "<option value='$row[$col_name]'";
            if(isset($_POST['chosenLanguage']) && $_POST['chosenLanguage'] == "$row[$col_name]"){
                echo "selected";
            }
            echo ">$row[$col_name]</option>";
          }
      }
    echo '</select></div>';

    // select day ?>
    <div class="col-md-2">
    <select class="form-control" required name="chosenDay">
        <option value="" >Select Day </option>
        <option value="Monday" <?php if(isset($_POST['chosenDay']) && $_POST['chosenDay'] == 'Monday'){ echo "selected"; } ?> > Monday</option>
        <option value="Tuesday" <?php if(isset($_POST['chosenDay']) && $_POST['chosenDay'] == 'Tuesday'){ echo "selected"; } ?>> Tuesday</option>
        <option value="Wednesday" <?php if(isset($_POST['chosenDay']) && $_POST['chosenDay'] == 'Wednesday'){ echo "selected"; } ?>> Wednesday</option>
        <option value="Thursday" <?php if(isset($_POST['chosenDay']) && $_POST['chosenDay'] == 'Thursday'){ echo "selected"; } ?>> Thursday</option>
        <option value="Friday" <?php if(isset($_POST['chosenDay']) && $_POST['chosenDay'] == 'Friday'){ echo "selected"; } ?>> Friday</option>
    </select></div>

    <div class="col-md-3">
    <!-- select start time -->
    <input class="form-control" type="text" name="chosenStartTime" pattern="[0-9][0-9]:00|30" title="please enter in 24 hour time" placeholder="Start time (24 hour format)" value="<?php if (isset($_POST['chosenStartTime'])) echo $_POST['chosenStartTime'] ?>">

  </div><div class="col-md-2">
    <input class="form-control" type="submit" name="submit" value="Select Class Times">
  </div></div>
</form>
</div>
