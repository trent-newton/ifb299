<h2>Refine list of Hire Requests</h2>

<form method="POST" action="../adminInstruments/adminHire.php">
    <div class="col-md-6 form-group">
        Search by UserID
        <input type="text" name="userID" class="form-control" pattern="[0-9]*" message="Numeric userID only">
    </div>

    <div class="col-md-6 form-group">
    Instrument Types
    <select class="form-control" name="InstrumentType">
        <?php
            $sql = "SELECT * FROM instrumentNames";
            $result = mysqli_query($con,$sql);
        ?>
      <option value="" disabled selected> Select... </option>
        <?php
        while($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['instrumentName'] . "'> " . $row['instrumentName'] . "</option>";
        }
      
        ?>
    </select>
    </div>
        
    <!-- Submit buttons -->
    <input type="submit" class="form-control" value="Show Instrument Requests"><br>
</form>
