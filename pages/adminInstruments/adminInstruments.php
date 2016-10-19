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

<div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../admin/admincenter.php">Admin Center</a> > <a href="../admin/instrumentsAdmin.php">Instrument Admin</a> > Manage Instruments</span>
        </div>
<div class="loginForm center-horizontal">
    

    <h2>Add New Instrument</h2>
    <form action="addNewInstrument.php" method="post">
        <input class="form-control" type="submit" name="NewInstrument" value="New Instrument" />
    </form>
<?php
    include "searchInstrument.php";
    echo "</div>"; 
    echo "<div class='content centered'>";
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
        echo "<h3>$type</h3>";
        echo "<table class='table'><tr>";
        
        foreach ($column as $name => $col_name) {
          echo "<th>$name</th>";
        }

        echo "<th> Modify Details </th>";

        while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($column as $name => $col_name) {
            echo "<td>";
              if($col_name == "hireCost") {
                  echo "$";
              }
              echo $row[$col_name] . "</td>";
          }
          echo '<td><a href="modifyInstrument.php?schoolInstrumentID='.$row['schoolInstrumentID'] . '"><span class="changeAccess"> Modify </span></a></td>';
          
            echo '</tr>';
          
        }

        // Close table
        echo "</table><br>";
    } else if (sizeof($instrumentTypes) == 1){
        echo "<h3> No Instruments found. Search Again.";
        break;
    }
}

    ?>

</div>
</div>

<?php
include "../../inc/footer.php";
?>