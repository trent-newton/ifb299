<?php
    $pagetitle = "User Management";
    include "../../inc/connect.php";
?>
<div class="loginForm centered">
<h2>Refine list of Users</h2>
<form method="POST" action="../change/changeAuth.php">
    <div class="col-md-6 form-group">
        UserID
        <input type="text" name="userID" class="form-control" pattern="[0-9]*" message="Numeric userID only">
    </div>

    <div class="col-md-6 form-group">
    Account Types
    <select class="form-control" name="accountType">
      <option value="" disabled selected> Select... </option>
      <option value="Guest">Guest</option>
      <option value="Student">Student</option>
      <option value="Teacher">Teacher</option>
      <option value="StudentAndTeacher">Student and Teacher</option>;
        <?php 
        if (isOwner($_SESSION['accountType'])){
          echo '<option value="Admin">Admin</option>
          <option value="Owner">Owner</option>';
        }
        ?>
    </select>
    </div>
        
    <!-- Submit buttons -->
    <input type="submit" class="form-control" value="Show Users"><br>
</form>
</div>