<?php
$pagetitle = "Login";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
?>

<?php
if(isset($_SESSION["userID"])) {
    header("location:../pages/index.php");
}
if(isset($_SESSION["error"])) {
    echo "<span class='error'>" . $_SESSION['error'] . "</span>";
    unset($_SESSION['error']);
}
?>
    <br><div class="content">

        <form class="loginForm" action="../inc/loginprocessing.php" method="post">
            <h2>Login</h2>
            <fieldset>
                <label>Email<span class="required">*</span>:</label><br />
                <input type="email" name="email" placeholder="name@example.com" required />
                <br />
                <label>Password<span class="required">*</span>:</label><br />
                <input type="password" name="password" placeholder="password" required />
                <p class="required">* Required Fields</p>

                <p><a href="../pages/forgotpassword">Forgot Password?</a></p>
                <input type="submit" name="login" value="Login" /> </fieldset>
        </form>
    </div>
    <!-- end content-->
    <?php
include "../inc/footer.php";
?>
