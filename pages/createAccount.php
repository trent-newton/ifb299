<?php
    include "../inc/header.php";
    include "../inc/nav.php";

    if(isset($_POST['submit'])) {

    } else if(isset($_POST['cancel'])) {
    	echo "Cancel";
    }
?>
    <div class="content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        	<h1>Student</h1>
        	<p style="color:#FF0000">* required field</p>
        	First Name: <input type="text" name="sFirstName"> * <?php if(isset($_POST['sFirstName'])) {echo("First name required");}?><br>
        	Last Name: <input type="text" name="sLastName"> *<br>
        	Date of Birth: <input name="dob"> *<br>
        	Postal Address: <input type="text" name="address"> *<br>
        	Gender: <input type="radio" name="gender" value="female">Female
        			<input type="radio" name="gender" value="male">Male  *<br>
			Mobile Phone: <input type="text" name="sMobile"> *<br>
			Other Phone: <input type="text" name="sPhone"><br>
			Facebook Link: <input type="text" name="facebook"><br>
			Email Address: <input type="text" name="sEmail"> *<br>
			Password: <input type="text" name="password"> *<br>
			Confrim Password: <input type="text" name="confirmPassword"> *<br>
			<h2>Parent/ Caregiver</h2>
			First Name: <input type="text" name="pFirstName"><br>
			Last Name: <input type="text" name="pLastName"><br>
			Email Address: <input type="text" name="pEmail"><br>
			Mobile Phone: <input type="text" name="pMobile"><br>
			Other Phone: <input type="text" name="pPhone"><br>
			Relation to student: <input type="text" name="relation"><br>
			<br>
			<button type="submit" name="submit">Submit</button>
			<button type="submit" name="cancel">Cancel</button>
        </form>
    </div>
    <!--end content-->
<?php
    include "../inc/footer.php";
?>