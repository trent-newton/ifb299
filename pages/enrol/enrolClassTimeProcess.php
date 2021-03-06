<?php
    $pagetitle = "Enrol";

    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    include "../../inc/authCheck.php";

    $accessLevel='';
    $userID='';
    if((isAdmin($_SESSION['accountType'])) || (isOwner($_SESSION['accountType'])))
    {
        $accessLevel = 'admin';
        $sql = "SELECT firstName ,lastName FROM users WHERE userID=$userID";
    }else if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Students can access the Enrol Page.";
        rejectAccess();
    }
    //for admins to add schedules for other users
    if($accessLevel == 'admin')
    {
      $userID = $_GET['userID'];
      $result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
      $name = mysqli_fetch_array($result);
      echo "<h1> Add class for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
    }  else {
      $userID = $_SESSION['userID'];
    }


    // get sent through data
    $day = $_POST['day'];
    $startTime = $_POST['startTime'];
    $instrument = $_POST['instrument'];
    $teacherID = $_POST['teacherID'];
    $studentID = $userID;
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    //get instrument type id
    $sql = "SELECT * FROM instrumentNames WHERE instrumentName='$instrument'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $instrumentTypeID = $row['instrumentTypeID'];

    //insert data into database
    $sql = "INSERT INTO contracts (teacherID, studentID, startDate, endDate, time, day, length, instrumentTypeID) VALUES ('$teacherID', '$studentID', '$startDate', '$endDate', '$startTime', '$day', '60', '$instrumentTypeID')";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>

<div class="content">
    <div class="breadcrumb">
        <span><a href="../home/index.php">Home</a> > <a href="../usercenter/usercenter.php">User Center</a> > Enrol</span>
    </div>
    <div class="content enrolPage">
        <h2>Class Added</h2>
        <p>Start Date: <?php echo $startDate?></p>
        <p>End Date: <?php echo $endDate?></p>
        <p>Day: <?php echo $day?></p>
        <p>Time: <?php echo $startTime?></p>
        <p>Instrument: <?php echo $instrument?></p>
    </div>
</div>

<?php
    //get student email
    $sql = "select email from users where userid = $studentID";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $studentEmail = mysqli_fetch_array($result);
    
    //get teacher email
    $sql2 = "select email from users where userid = $teacherID";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    $teacherEmail = mysqli_fetch_array($result2);

    //Body of email to be sent
    $message = "confirmed contract info: day: $day, start time: $startTime, start date: $startDate, end date: $endDate";
    $message = wordwrap($message, 70, "\r\n");

    //send email
    mail($studentEmail['email'], 'Confirmed Contract', $message);
    mail($teacherEmail['email'], 'Confirmed Contract', $message);

    include "../../inc/footer.php";
?>
