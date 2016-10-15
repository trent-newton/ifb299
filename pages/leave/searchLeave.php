<h2>Refine list of Leave Requests</h2>

<div class="loginForm centered">
<form method="POST" action="../leave/reviewLeaveRequests.php">
    <div class="col-md-6 form-group">
        Search by UserID
        <input type="text" name="userID" class="form-control" pattern="[0-9]*" message="Numeric userID only">
    </div>

    <div class="col-md-6 form-group">
    Status
    <select class="form-control" name="status">
        <?php
            $sql = "SELECT DISTINCT leaverequests.status FROM leaverequests";
            $result = mysqli_query($con,$sql);
        ?>
      <option value="" disabled selected> Select... </option>
        <?php
        while($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['status'] . "'> " . $row['status'] . "</option>";
        }

        ?>
    </select>
    </div>

    <!-- Submit buttons -->
    <input type="submit" class="form-control" value="Show Leave Requests"><br>
</form>
</div>
