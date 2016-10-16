<?php
$pagetitle = "Reset Password";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
?>
<div class="content">
    <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../login/login.php">Login</a> >  Reset Password</span>
        </div>
<?php
    if(isset($_GET['emailCode']) && isset($_GET['email'])) {
        $emailCode = $_GET['emailCode'];
        $email = $_GET['email'];
        $sql = "SELECT forgotPassword.userID, firstName, lastName, email, emailCode FROM users INNER JOIN  forgotPassword ON users.userID=forgotPassword.userID WHERE emailCode='$emailCode' AND email='$email' ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $numrow = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        $userID = $row['userID'];

        if($numrow == 1) {
            ?>
    <div class='loginForm center-horizontal'>
        <form action="../../inc/forgotpassword.php" method="post">
            <p>Change the password for <?php echo $row['firstName'] . " " . $row['lastName'];?></p>
            <label>New Password<span class="required">*</span>:</label>
            <br />
            <input class="form-control" type="password" name="newPassword" pattern=".{8,}" title="Password must be 8 characters oir more" required />
            <br />
            <label>Re-Enter Password<span class="required">*</span>:</label>
            <br />
            <input class="form-control" type="password" name="newPassword2" pattern=".{8,}" required />
            <br />
            <input class="form-control" type="hidden" name="userID" value="<?php echo $userID ?>" />
            <br />
            <input class="form-control" type="hidden" name="email" value="<?php echo $email ?>" />
            <input class="form-control" type="hidden" name="emailCode" value="<?php echo $emailCode ?>" />
            <input class="form-control" type="submit" name="passwordUpdate" value="Update Password" />
        </form>
    </div>
    <?php
        }
    } else {
        ?>
    <div class='loginForm center-horizontal'>
        <form method="post" action="../../inc/resetuserpassword.php">
            <p>Click to send a reset link to your email.</p>
            <label>Email<span class="required">*</span>:</label><br />
            <input class="form-control" type="email" name="email" required />
            <p><input class="form-control" type="submit" name="passwordreset" value="Reset Password" /></p>
        </form>
    </div>
    <?php
    }

?>

</div><!--end content-->

<?php
include "../../inc/footer.php";
?>
