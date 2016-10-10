<?php
    $pagetitle = "User Management";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";
        
    if (!isGuest($_SESSION['accountType'])){
        rejectAccess();
        $_SESSION['success'] = "Only guest users can apply";
        //name, age, gender, email, phone number, proficient instruments, languages, availability, facebook ID
    }
    $userID = $_SESSION['userID'];
    $sql = "SELECT * FROM users LEFT JOIN useraddress ON users.UserID=useraddress.userID LEFT JOIN address ON useraddress.addressID=address.addressId WHERE users.userID='$userID' ";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);

    //query to find list of instruments
    $resultInstrument = mysqli_query($con,"SELECT distinct instrumentName FROM instrumentNames");
?>

<h1>Apply to become a teacher</h1>
<div>
    <form method="post" action="../../inc/updateaccount.php">
        First Name (Read Only):
        <input class="form-control" type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly />

        Last Name (Read Only):
        <input class="form-control" type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly />

        DOB (Read Only):
        <input class="form-control" type="date" value="<?php echo $row['DOB']?>" readonly />

        Gender (Read Only):
        Male
        <input type="radio" name="gender" class="inputStreet"<?php if($row['gender']=='Male' ) {echo "checked";}?> readonly/>
        Female
        <input type="radio" name="gender" class="inputStreet" <?php if($row['gender']=='Female' ){ echo "checked";}?> readonly />
        
        <br><br>
        Instruments I Can Teach:
        <br>
        
        <?php // Instruments list 
        while($row = mysqli_fetch_array($resultInstrument)) {
            $columnInstrument  = array('instrumentName' => 'instrumentName' );

            foreach ($columnInstrument as $name => $col_name) {
                echo "<input type='checkbox' name='instrument' value='$row[$col_name]'>$row[$col_name]<br>";
                /*
                  if(isset($_POST['chosenInstrument']) && $_POST['chosenInstrument'] == "$row[$col_name]"){
                    echo "selected"; 
                }*/
            }
        }
        
        //Availability
        $daysOfWeek = array(
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                    );
        
        echo "<label>Availability</label><br>";
         /*
        echo "<input class='form-control'"
       
        <input class="form-control" type="text" name="chosenStartTime" pattern="[0-9][0-9]:00|30" title="please enter in 24 hour time" placeholder="Start time (24 hour format)" value="<?php if (isset($_POST['chosenStartTime'])) echo $_POST['chosenStartTime'] ?>">*/
            
        //Langauges
        $resultLanguage = mysqli_query($con,"SELECT distinct language FROM languages");
        while($row = mysqli_fetch_array($resultLanguage)) {
            $columnLangauge  = array('language' => 'language' );

            foreach ($columnLangauge as $name => $col_name) {
                echo "<input type='checkbox' name='langauge' value='$row[$col_name]'>$row[$col_name]<br>";
                /*
                  if(isset($_POST['chosenInstrument']) && $_POST['chosenInstrument'] == "$row[$col_name]"){
                    echo "selected"; 
                }*/
            }
        }
        ?> 
        
        
        
        
        <br>
        <input type="submit" class="form-control" value="Submit Application"/> 
    </form>    
</div>

<?php
    include "../../inc/footer.php";
?>