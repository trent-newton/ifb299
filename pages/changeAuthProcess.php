<?php
$pagetitle = "change authorisation";

include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";

// Get selected userID
$userID = $_GET['userID'];

$column = array(
  'firstName' => 'firstName',
  'lastName' => 'lastName',
    'accountType' => 'accountType'
);

// Run the query & fetch results
$result= mysqli_query($con,"SELECT firstName, lastName, accountType FROM users WHERE userID = $userID");
$name = mysqli_fetch_array($result);

// Print header
echo "<h1> Change authorisation for ".$name['firstName']." ".$name['lastName']." (userID $userID) </h1>";
// Simple form with account types
echo'<br> Change authorisation to: 
<form method="post" action="changeAuthResult.php?userID='.$userID.'">
    <select required name="accessChosen">
      <option value="" disabled selected> Select... </option>
      <option value="Guest">Guest</option>
      <option value="Student">Student</option>
      <option value="Teacher/Teacher">Student & Teacher</option>
      <option value="Admin">Admin</option>
      <option value="Owner">Owner</option>
    </select>
    <input type="submit" value="Amend Changes">
</form>';

include "../inc/footer.php";
?>