<body>
        <div class="container">
          <span>
            <!--Need to add images here for logo etc -->
            <div class="headerContainer">

            <!--end HeaderContainer-->
            <div class="userPanel">
                <div class="userInfo">
                    <?php
                    //If a user is logged in
                    if(isset($_SESSION['userID'])) {
                        $userID = $_SESSION['userID'];
                        $sql = "SELECT firstName, lastName FROM users WHERE userID='$userID'";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $userName = $row['firstName'] . " " . $row['lastName'];
                    ?>
        <?php
        if((($_SESSION['accountType']) == 'Admin') || (($_SESSION['accountType']) == 'Owner')){
          echo '<a href="../pages/admincenter.php">Admin Center</a><br />';
        } else if ($_SESSION['accountType'] == 'Student' || $_SESSION['accountType'] == 'Teacher' || $_SESSION['accountType'] == 'StudentAndTeacher') {
          echo '
                <div class="userPanelImage">
                <img src="../images/userImage/default-user-icon.png" />
                </div>
                <a href="../pages/usercenter.php">
                User Center</a><br />';
        }
        ?>
        <div class="userPanelImage">
        <img src="../images/userImage/logout.png" />
        </div>
         <a href="../pages/logout.php">Logout</a></span>

                    <?php
                        } else { // if no user is logged in
                    ?>
                    <!--LOGIN-->
                    <div class="userPanelImage">
                    <img src="../images/userImage/login.png" />
                    </div>
                     <a href="../pages/login.php">Login</a></span> <br>
                
                   <!--Register-->
                    <div class="userPanelImage">
                    <img src="../images/userImage/register.png" />
                    </div>
                     <a href="../pages/createAccount.php">Register</a></span>
                
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

                <div class="logo"> <img src="../images/TempLogo.png" /> </div>
                <!--end logo-->
            </div>
          </span>
            <nav id="nav" role="navigation"> <a href="#nav" title="Show Navigation">Show Navigation</a> <a href="#" title="Hide Navigation">Hide Navigation</a>

                <ul>
                    <li><a href="../pages/index.php">Home</a></li><!--
                    --><li><a href="../pages/about.php">About</a></li><!--
                    --><li><a href="../pages/faq.php">FAQ</a></li><!--
                    --><li><a href="../pages/contact.php">Contact Us</a></li>
                </ul>

            </nav><!-- end Nav-->

            <?php if($pagetitle == "About Us | Pinelands Music School"): ?>
              <div class="banner"> <img src="../images/banners/about.jpg" />
            <?php elseif($pagetitle == "Enrol | Pinelands Music School"): ?>
              <div class="banner"> <img src="../images/banners/enrol.jpg" />
            <?php elseif($pagetitle == "Contact Us | Pinelands Music School"): ?>
              <div class="banner">
            <?php else: ?>
              <div class="banner"> <img src="../images/banners/main.jpg" />
            <?php endif ?>
                  </div>
