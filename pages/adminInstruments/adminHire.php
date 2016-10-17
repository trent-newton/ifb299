<?php
$pagetitle = "Admin Hire Instruments";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>
<div class="content centered">
    <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/instrumentsAdmin.php">Instrument Admin</a> > Hire Requests</span>
        </div>
    <?php
    include "searchHires.php";
    
    //get variables from searchUsers on if they are set
if (isset($_POST["userID"])){
    $userID = $_POST["userID"];
} else {
    $userID = null;
}

if (isset($_POST["InstrumentType"])){
    $instrumentType = $_POST["InstrumentType"];
} else {
    $instrumentType = null;
}
    
    $column = array(
        'First Name' => 'firstName',
        'Last Name' => 'lastName',
        'Instrument Type' => 'instrumentName',
        'Day' => 'day',
        'Time' => 'time',
        'Approved'=> 'adminApproved',
    );
    
    //show specified account type if set, otherwise show all account types  
if ($instrumentType != null){
    $instrumentTypes = array(
         0 => $instrumentType
    );
} else {
    $instrumentTypes = array();
    $sql = "SELECT * FROM instrumentNames";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)) {
        array_push($instrumentTypes, $row['instrumentName']);
    }
    
}
    
foreach ($instrumentTypes as $type) {
    //if userID set show only that user, else show all of this account type
    if ($userID != null){
        $sql = "SELECT * FROM instrumentHire INNER JOIN contracts ON instrumentHire.contractID=contracts.contractID INNER JOIN schoolInstruments ON instrumentHire.schoolInstrumentID=schoolInstruments.schoolInstrumentID INNER JOIN instrumentNames ON schoolInstruments.instrumentTypeID=instrumentNames.instrumentTypeID INNER JOIN users ON contracts.studentID=users.userID WHERE studentID='$userID' and instrumentName='$type' and archived='0'";
        $result = mysqli_query($con,$sql);
        $count = mysqli_num_rows($result);
    } else {
        $sql = "SELECT * FROM instrumentHire INNER JOIN contracts ON instrumentHire.contractID=contracts.contractID INNER JOIN schoolInstruments ON instrumentHire.schoolInstrumentID=schoolInstruments.schoolInstrumentID INNER JOIN instrumentNames ON schoolInstruments.instrumentTypeID=instrumentNames.instrumentTypeID INNER JOIN users ON contracts.studentID=users.userID WHERE instrumentName='$type'and archived='0'";
        $result = mysqli_query($con,$sql);
        $count = mysqli_num_rows($result);
    }
    
    //only create table if account type has 1 or more users
    if ($count > 0) {
        echo "<h3>$type</h3>";
        echo "<table class='table centered'><tr>";
        
        foreach ($column as $name => $col_name) {
          echo "<th>$name</th>";
        }

        echo "<th> Approve Hire </th>";
        echo "<th> Deny Hire </th>";
        

        while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($column as $name => $col_name) {
            echo "<td>";
            if($name == 'Approved') {
                if($row[$col_name] == null){
                  echo "<span>Please Select</span>";
              } elseif($row[$col_name] == 'No') {
                  echo "<span class='error'>Denied</span>";
              } elseif($row[$col_name] == 'Yes') {
                  echo "<span class='success'>Approved</span>";
              }
            } else {
                echo $row[$col_name];
            }
              echo "</td>";
          }
          echo '<td><a  href="modifyHire.php?instrumentHireID='.$row['instrumentHireID'] . '&approved=Yes"><img src="../../images/tick.png" /></a></td>';
          echo '<td><a href="modifyHire.php?instrumentHireID='.$row['instrumentHireID'] . '&approved=No"><img src="../../images/cross.png" /></a></td>';
          
            echo '</tr>';
          
        }

        // Close table
        echo "</table><br>";
    } else if (sizeof($instrumentTypes) == 1){
        echo "<h3> No Instrument Hires found. Search Again.";
        break;
    }
}

    ?>

</div>


<?php
include "../../inc/footer.php";
?>