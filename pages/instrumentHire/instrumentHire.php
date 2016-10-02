<?php
    $pagetitle = "Instrument Hire";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
    require "../../inc/authCheck.php";

    if(!(isStudent($_SESSION['accountType'])) && !(isStudentTeacher($_SESSION['accountType']))) {
        $_SESSION['error'] = "Only Students can access this page.";
        rejectAccess();
    }

    $sqlGetContracts = "SELECT * FROM contracts WHERE studentID='$userID'";
    $resultGetContracts = mysqli_query($con, $sqlGetContracts) or die(mysqli_error($con));
?>

<div class="content">
    <select class="form-control" onchange="showContract(this.value)">
    <option value="">Select a contract...</option>
    <?php
        while ($row = mysqli_fetch_array($resultGetContracts)) {
            echo "<option value=".$row['contractID']."> ".$row['day']." ".$row['time']."</option>";
        }
    ?>
    </select>

    <div id="txtData"></div>

</div>

<?php include "../../inc/footer.php"; ?>

<!-- Select Box Functionality -->
<script>
    function showContract(str) {
        if (str == "") {
            document.getElementById("txtData").innerHTML = "";
            document.getElementById("selectStartDate").innerHTML = "";
            document.getElementById("selectEndDate").innerHTML = "";
            return;
        } else {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtData").innerHTML = this.responseText;

                    // Get start and end date
                    var dates = this.responseText.match(/[0-9]{4}-[0-9]{2}-[0-9]{2}/g);
                    var startDate = new Date(dates[0]);
                    var endDate = new Date(dates[1]);

                    // Get number of weeks between dates
                    var millisInWeek = 604800000;
                    var numWeeks = Math.floor((endDate.getTime() - startDate.getTime()) / millisInWeek);

                    // Put dates each week in option form
                    for (var i = 0; i <= numWeeks; i++) {
                        var date = new Date(startDate.getTime() + (i * 604800000));
                        var dateString = date.getFullYear() + "-" + FormatDigits(date.getMonth() + 1) + "-" + FormatDigits(date.getDate());

                        var optStart = document.createElement('option');
                        optStart.innerHTML = dateString;
                        optStart.values = dateString;
                        document.getElementById("selectStartDate").append(optStart);

                        var optEnd = document.createElement('option');
                        optEnd.innerHTML = dateString;
                        optEnd.values = dateString;
                        document.getElementById("selectEndDate").append(optEnd);
                        }
                    }
                };
            xmlhttp.open("GET","getContract.php?q="+str, true);
            xmlhttp.send();
        }
    }

    // Format to 2 places
    function FormatDigits(num) {
        if (num > 9) {
            return num;
        } else {
            return "0" + num;
        }
    }
</script>