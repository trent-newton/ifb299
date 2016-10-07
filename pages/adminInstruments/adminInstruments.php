<?php
$pagetitle = "Manage Instruments";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
include "../../inc/authCheck.php";

if(!(isOwner($_SESSION['accountType'])) && !(isAdmin($_SESSION['accountType']))){
    $_SESSION['error'] = "Only Administrators can access the Admin Center.";
    rejectAccess();
}
?>
<div class="content">
<?php
    include "searchInstrument.php";
    
    //get variables from searchUsers on if they are set
if (isset($_POST["schooolInstrumentID"])){
    $schooolInstrumentID = $_POST["schooolInstrumentID"];
} else {
    $schooolInstrumentID = null;
}

if (isset($_POST["InstrumentType"])){
    $instrumentType = $_POST["InstrumentType"];
} else {
    $instrumentType = null;
}
    
    $column = array(
        'InstrumentID' => 'schoolInstrumentID',
        'Condition' => 'instrumentCondition',
        'Hire Cost' => 'hireCost',
        
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
    if ($schooolInstrumentID != null){
        $sql = "SELECT * FROM schoolinstruments INNER JOIN instrumentnames ON schoolinstruments.instrumentTypeID=instrumentnames.instrumentTypeID  WHERE schoolInstrumentID='$schooolInstrumentID' and instrumentName='$type'";
        $result = mysqli_query($con,$sql);
        $count = mysqli_num_rows($result);
    } else {
        $sql = "SELECT * FROM schoolinstruments INNER JOIN instrumentnames ON schoolinstruments.instrumentTypeID=instrumentnames.instrumentTypeID WHERE instrumentName='$type'";
        $result = mysqli_query($con,$sql);
        $count = mysqli_num_rows($result);
    }
    
    //only create table if account type has 1 or more users
    if ($count > 0) {
        echo "$type<br>";
        echo "<table id='changeAuthTables'><tr>";
        
        foreach ($column as $name => $col_name) {
          echo "<th>$name</th>";
        }

        echo "<th> Modify Details </th>";

        while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($column as $name => $col_name) {
            echo "<td>" . $row[$col_name] . "</td>";
          }
          echo '<td><a href="modifyInstrument.php?schoolInstrumentID='.$row['schoolInstrumentID'] . '"><span class="changeAccess"> Modify </span></a></td>';
          
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