<?php
    $pagetitle = "Teacher Application";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";
        
    if (!isGuest($_SESSION['accountType']) && !isStudent($_SESSION['accountType'])){
        rejectAccess();
        $_SESSION['success'] = "Only guest users can apply";
    }
    
    //check if user had already made application
    $userID = $_SESSION['userID'];
    $query = "SELECT * FROM applications WHERE userID = '$userID' ";
    $resultCheckSubmission = mysqli_query($con, $query);
    $rowcount=mysqli_num_rows($resultCheckSubmission);

    if ($rowcount > 0){
        echo "<h1>You have already submitted an application with us. Good Luck!</h1>";
    } else {        
        $sql = "SELECT * FROM users WHERE userID='$userID'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result);
    ?>

    <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > Apply to become a Teacher</span>
    </div>  

    <h1 class="centered">Apply to become a teacher</h1>
    <h4>Already stored information</h4>
    <form method="post" action="teacherApplyProcess.php" enctype="multipart/form-data">
        <div class="col-md-4 form-group">
            <input class="form-control" type="hidden" name="userID" value="<?php echo $row['userID']?>" readonly />
            First Name (Read Only):
            <input class="form-control" type="text" name="firstName" value="<?php echo $row['firstName']?>" readonly />
        </div>

        <div class="col-md-4 form-group">
            Last Name (Read Only):
            <input class="form-control" type="text" name="lastName" value="<?php echo $row['lastName']?>" readonly />
        </div>

        <div class="col-md-4 form-group">
            DOB (Read Only):
            <input class="form-control" type="date" value="<?php echo $row['DOB']?>" readonly />
        </div>


        <h4>Fill out the Application form below</h4>
        <label>Proficient Instruments</label>
        <br>

        <?php // Instruments list 
        echo '<div class="col-md-4 form-group">';
        //query to find list of instruments
        $resultInstrument = mysqli_query($con,"SELECT distinct * FROM instrumentNames");

        while($row = mysqli_fetch_array($resultInstrument)) {    
            echo "<input type='checkbox' name='check_list[]' value='$row[1]'>$row[1]<br>";
        }
        echo '</div>';
        

        //Langauges
        echo "<label>Fluent Languages</label><br>";
        $resultLanguage = mysqli_query($con,"SELECT distinct language FROM languages");
        while($row = mysqli_fetch_array($resultLanguage)) {
            echo "<input type='checkbox' name='check_list[]'";
            if ($row[0] == "English"){
                echo" checked required";
            }
            echo "value='$row[0]'>$row[0]<br>";
        }
        ?> 
        
        <div class="col-md-3 form-group">
            <br><label>Availability (hours per week)</label>
            <input type="number" class="form-control" name="availability" min="5" max="50" required/>
        </div>
   
        <div class="col-md-12 form-group">
            <p><label>Upload your Resumee (pdf only)</label></p>
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
        </div>
        <br>
        <input type="submit" class="form-control" value="Submit Application"/> 
    </form>    
   

    <?php
}
    include "../../inc/footer.php";
?>