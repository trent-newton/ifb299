<?php
    $pagetitle = "View Teacher Applications";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";

    if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
        $_SESSION['error'] = "Only Administrators can review Teacher Applications.";
        rejectAccess();
    }
?>


<div class="content">
  <div class="breadcrumb">
    <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/adminReviewApplications.php">Review Teacher Applications</a> > View Full Application</span>
  </div>
<div class="adminCenter">
<?php
//if there is no userID in the address bar then give error. If there is then it proceeds like normal
  if(isset($_GET['userID'])) {

    $userID = $_GET['userID'];
    $sqlUserInfo = "SELECT applications.filename, applications.language, applications.availability, applications.instrument,
                    users.firstname, users.lastname, users.DOB, users.gender, users.facebookID, users.email, users.accountType
                    FROM applications INNER JOIN users ON applications.userID = users.userID
                    WHERE users.userID = '$userID'";
    $resultUserInfo = mysqli_query($con, $sqlUserInfo);
    $rowUserInfo = mysqli_fetch_array($resultUserInfo);


    $sqlPhonenumbers = "SELECT phonenumbers.phonenumber FROM phonenumbers WHERE phonenumbers.userID = $userID";
    $resultPhonenumbers = mysqli_query($con, $sqlPhonenumbers);

    $sqlAddress = "SELECT address.unitNumber, address.streetNumber, address.streetName, address.streetType,
                    address.suburb, address.postCode, address.state
                    FROM address INNER JOIN userAddress ON address.addressID = useraddress.addressID
                    WHERE useraddress.userID = '$userID'";
    $resultAddress = mysqli_query($con, $sqlAddress);
    $rowAddress = mysqli_fetch_array($resultAddress);


    echo '<h1>Review '.$rowUserInfo['firstname']."'s".' Applications</h1>';
    if($rowUserInfo['accountType'] = 'Student'){
      echo '<p>This user is also a student</p>';
    }
    echo '<div class="row ">';
      echo '<div class="col-md-4 col-md-offset-2 text-left">';
      echo '<br><b>Full name:</b> '.$rowUserInfo["firstname"].' '.$rowUserInfo["lastname"];
      echo '<br><b>DOB:</b> '.$rowUserInfo["DOB"];
      echo '<br><b>Gender:</b> '.$rowUserInfo["gender"];
      echo '<br><br><b>Facebook:</b> '.($rowUserInfo["facebookID"] == null? 'N/A':$rowUserInfo["facebookID"]);
      echo '<br><b>Email:</b> '.$rowUserInfo["email"];
      $phoneNumberCount = 0;
      while($rowPhonenumbers = mysqli_fetch_array($resultPhonenumbers))
      {
        $phoneNumberCount ++;
        echo '<br><b>Phone Number '.$phoneNumberCount.':</b> '.$rowPhonenumbers["phonenumber"];
      }
      echo '<br><br><b>Address:</b> '.($rowAddress["unitNumber"] == null? '':$rowAddress["unitNumber"].' ');
      echo $rowAddress["streetNumber"].' '.$rowAddress["streetName"].' '. $rowAddress["streetType"];
      echo '<br>'.$rowAddress["suburb"].' '.$rowAddress["postCode"].' '. $rowAddress["state"];
      echo '</div>';

      echo '<div class="col-md-4 text-left">';
      echo '<br><b>Instrument/s:</b> '.str_replace(' ', ', ',$rowUserInfo['instrument']);
      echo '<br><br><b>Language/s:</b> '.str_replace(' ', ', ', $rowUserInfo['language']);
      echo '<br><br><br><br><br><a href="teacherResume.php?fileName='.$rowUserInfo['filename'].'"><b>Download Resume</b></a>';
      echo '</div>';
    echo '</div>';

  } else {
    echo '<h1>An error has occured. Please go back to the previous page.</h1>';
  }


?>
</div></div>

    <?php
        include "../../inc/footer.php";
    ?>
