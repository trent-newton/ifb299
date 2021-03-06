<?php
$pagetitle = "Admin Center";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";


if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}

$column = array(
  'UserID' => 'userID',
  'First Name' => 'firstName',
  'Last Name' => 'lastName'
);

$sql = "SELECT userID, firstname, lastname FROM user WHERE accountType ='Student'"; //also add student teachers??
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
?>

<table class='table'>
    <tr>
        <?php //list table headings
        foreach ($column as $name => $col_name) {
            echo "<th>$name</th>";
        }
        ?>
        <th>Modify user</th>
    </tr>
    <?php
     while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($column as $name => $col_name) {
            echo "<td>". $row[$col_name] . "</td>";
        }
        echo '<td><a href="../change/changeAuthProcess.php?userID='.$row['userID'].'"><span class="required"> change access </span></a></td></tr>';
    }
    ?>
</table>



<?php include "../../inc/footer.php";  ?>
