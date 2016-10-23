<?php
    $pagetitle = "Enrol";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    include "../../inc/authCheck.php";

    $userID='';
    if((isAdmin($_SESSION['accountType'])) || (isOwner($_SESSION['accountType'])))
    {
        $sql = "SELECT firstName ,lastName FROM users WHERE userID=$userID";
    } else if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Students can access the Enrol Page.";
        rejectAccess();
    }

    //for admins to add schedules for other users
    if(isAdmin($_SESSION['accountType']))
    {
      $userID = $_GET['userID'];
      $result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
      $name = mysqli_fetch_array($result);
      echo "<h1> Add class for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
    } else {
      $userID = $_SESSION['userID'];
    }

    //get data from form
    $day = $_GET['day'];
    $startTime = $_GET['startTime'];
    $instrument = $_GET['instrument'];
    $teacherID = $_GET['teacherID'];
    $studentID = $userID;
?>
<div class="content">
    <div class="breadcrumb">
        <span><a href="../home/index.php">Home</a> > <a href="../usercenter/usercenter.php">User Center</a> > Enrol</span>
    </div>

    <div class="loginForm center-horizontal">
        <?php
            if(isAdmin($_SESSION['accountType']))
            {
              echo '<form class="basic-form" action="enrolClassTimeProcess.php?userID='.$userID.'" method="post">';
            } else {
              echo '<form class="basic-form" action="enrolClassTimeProcess.php" method="post">';
            }
            //dates to set in form
            $todayDate = date('Y-m-d');
            $todayDay = date('d');
            $todayYear = date('Y');
            $todayMonth = date('m');
        
            $oneMonthLater = date('m') + 1;
            $twoMonthLater = date('m') + 2;
            $oneYearLater = date('Y') + 1;
            
            $oneMonthLaterDate = "$todayYear-$oneMonthLater-$todayDay";
            $twoMonthLaterDate = "$todayYear-$twoMonthLater-$todayDay"; 
            $oneYearLaterDate = "$oneYearLater-$todayMonth-$todayDay";  
        ?>
        <h2>Contract Duration</h2><h4>
            Start Date (Must start within the next month)
            <input class="form-control" type="date" name="startDate" 
                   min="<?php echo "$todayDate"; ?>" 
                   max="<?php echo "$oneMonthLaterDate"; ?>" 
                   required /><br>
            End Date (Max duration of 1 year)
            <input class="form-control" type="date" name="endDate"
                   min="<?php echo "$twoMonthLaterDate"; ?>" 
                    max="<?php echo "$oneYearLaterDate"; ?>" 
                   required />
            <input type="hidden" name="day" value="<?php echo $day?>" />
            <input type="hidden" name="startTime" value="<?php echo $startTime?>" />
            <input type="hidden" name="instrument" value="<?php echo $instrument?>" />
            <input type="hidden" name="teacherID" value="<?php echo $teacherID?>" />
            <input type="hidden" name="studentID" value="<?php echo $studentID?>" />
            <input class="form-control" type="submit" name="Submit" value="submit" />
        </form>
    </div>
</div><!--end content-->
<?php include "../../inc/footer.php"; ?>