<?php
$pagetitle = "About";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

$column = array(
  'UserID' => 'userID', 
  'First Name' => 'firstName',
  'Last Name' => 'lastName'
);

// Run the query
$result= mysqli_query($con,"SELECT userID, firstName, lastName FROM users");

// Output table header -- change this 
echo "<table><tr>";
foreach ($column as $name => $col_name) {
  echo "<th>$name</th>";
}

// output change access heading 
echo "<th> change access </th> </tr>";

// Output rows 
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  foreach ($column as $name => $col_name) {
    echo "<td>". $row[$col_name] . "</td>";
  }
  echo '<td><a href="changeAuthProcess.php?userID='.$row['userID'].'">change access</a></td></tr>';
}
// Close table
echo "</table>";

include "../inc/footer.php";
?>