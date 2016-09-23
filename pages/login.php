<?php
$pagetitle = "Login";
include "../inc/connect.php";
include "../inc/header.php";
include "../inc/nav.php";
?>

    <div class="content">
<?php
            if(isset($_SESSION["loginError"])) {
                echo "<span class='error loginError'>" . $_SESSION['loginError'] . "</span>";
                unset($_SESSION['loginError']);
            }
            ?>

            <h2 class="centered">Login</h2>
            <fieldset class="loginForm center-horizontal">
                <form action="../inc/loginprocessing.php" method="post">
                <label>Email<span class="required">*</span>:</label><br />
                <input class="emailInput" type="email" name="email" placeholder="name@example.com" required />
                <br />
                <label>Password<span class="required">*</span>:</label><br />
                <input type="password" name="password" placeholder="password" required />
                <p class="required">* Required Fields</p>

                <p><a href="../pages/resetpassword.php">Forgot Password?</a></p>
                <input type="submit" name="login" value="Login" />
                </form>
            </fieldset>


    </div>
    <!-- end content-->
    <?php
include "../inc/footer.php";
?>
