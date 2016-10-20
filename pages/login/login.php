<?php
$pagetitle = "Login";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
?>

    <div class="content">
        <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > Login</span>
        </div>

            <h2 class="centered">Login</h2> 
            <fieldset class="loginForm center-horizontal">
                <p class="required">* Required Fields</p>
                <form action="../../inc/loginprocessing.php" method="post">
                <label>Email<span class="required">*</span>:</label><br />
                <input class="form-control" class="emailInput" type="email" name="email" placeholder="name@example.com" required />
                    
                <label>Password<span class="required">*</span>:</label><br />
                <input class="form-control" type="password" name="password" placeholder="password" required />

                <input class="form-control" type="submit" name="login" value="Login" />
                <br>
                <p><a href="../resetpassword/resetpassword.php">Forgot Password?</a></p>
                </form>
            </fieldset>


    </div>
    <!-- end content-->
    <?php
include "../../inc/footer.php";
?>
