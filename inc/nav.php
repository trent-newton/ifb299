<body>
    <div class="userPanel">
        <div class="container">
            <!--Need to add images here for logo etc -->
            <div class="headerContainer">
                <div class="logo"> <img src="../images/TempLogo.png" /> </div>
                <!--end logo-->
                <div class="banner">
                    <a href="../pages/index.php"><img src="../images/musicbanner.jpg" /></a>
                </div>
                <!--end banner-->
            </div>
            <!--end HederContainer-->
            <div class="userPanel">
                <div class="userPanelImage">
                <img src="../images/userImage/default-user-icon.png" />
                </div>
                <div class="userInfo">
                    <?php
                    //If a user is logged in
                        if(isset($_SESSION['userID'])) {
                            ?>
                        <span><a href="../pages/myaccount.php">My Account</a> | <a href="../pages/usercenter.php">User Center</a> | <a href="../pages/logout.php">Logout</a></span>
                    <?php
                        } else { // if no user is logged in
                    ?>
                <span><a href="../pages/login.php">Login</a> | <a href="../pages/createAccount.php">Register Account</a></span>
                    <?php
                        }
                    ?>
                    </div><!--end userInfo-->
                    <div class="userMessage">
                <?php //Displays Success or Error messages
                    if(isset($_SESSION['success'])) {
                        echo "<span class='success'>" . $_SESSION['success'] .  "</span>";
                        unset($_SESSION['success']);
                    } elseif(isset($_SESSION["error"])) {
                        echo "<span class='error'>" . $_SESSION['error'] . "</span>";
                        unset($_SESSION['error']);
                    }

                    ?>
                    </div> <!--end userMessage-->


                </div><!-- end userPanel-->
            <nav id="nav" role="navigation"> <a href="#nav" title="Show Navigation">Show Navigation</a> <a href="#" title="Hide Navigation">Hide Navigation</a>

                <ul>
                    <li><a href="../pages/index.php">Home</a></li><!--
                    --><li><a href="../pages/about.php">About</a></li><!--
                    --><li><a href="../pages/faq.php">FAQ</a></li><!--
                    --><li><a href="../pages/contact.php">Contact Us</a></li>
                </ul>

            </nav>
            <!-- end Nav-->
            <!--<div class="userCenter">
                <img src="../images/userImage/default-user-icon.png" />
                <p><a href="../pages/login.php">Login</a> | <a href="../pages/createAccount.php">Create Account</a></p>
                <?php
                if(isset($_SESSION["success"])) //If there is a session success message
                {
                    echo "<span class='success'>" . $_SESSION['success'] . "</span>";
                    unset($_SESSION['success']);
                }
                elseif(isset($_SESSION['error'])) {
                    echo "<span class='error'>" . $_SESSION['error'] . "</span>";
                    unset($_SESSION['error']);
                }
            ?>
                    <ul class="loggedInMenu">
                        <li><a href="../pages/enrol.php">Enrol</a></li>
                        <li><a href="../pages/timetable.php">View Timetable</a></li>
                        <li><a href="../pages/changeClass.php">Request Class Change</a></li>
                        <li><a href="../pages/timetable.php">Instrument Hire</a></li>
                        <li><a href="../pages/lessonReview.php">Lesson Review</a></li>
                        <li><a href="../pages/leaveofAbsence.php">Leave of Absence</a></li>
                    </ul>
            </div>-->
            <!--end userCenter-->
