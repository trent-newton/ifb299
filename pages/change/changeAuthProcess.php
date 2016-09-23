<?php
$pagetitle = "change authorisation";

include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
require "../../inc/authCheck.php";

if (!isOwner($_SESSION['accountType']) && !isAdmin($_SESSION['accountType'])){
    rejectAccess();
}
// Get selected userID
$userID = $_GET['userID'];

// Run the query & fetch results
$result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
$name = mysqli_fetch_array($result);
echo "<div class='content'>";
// Print header
echo "<h1> Change authorisation for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
// Simple form with account types
echo'<br> Change authorisation to:
<form class="basic-form" method="post" action="changeAuthResult.php?userID='.$userID.'">
    <select class="form-control" required name="accessChosen">
      <option value="" disabled selected> Select... </option>
      <option value="Guest">Guest</option>
      <option value="Student">Student</option>
      <option value="Teacher">Teacher</option>
      <option value="StudentAndTeacher">Student & Teacher</option>';

      if (isOwner($_SESSION['accountType'])){
          echo '<option value="Admin">Admin</option>
          <option value="Owner">Owner</option>';
        }
    echo '</select>
    <input class="form-control" type="submit" value="Amend Changes">
</form>';

echo "</div>";

include "../../inc/footer.php";
?>
