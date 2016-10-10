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

                <div class="logo"> <img src="../../images/TempLogo.png" /> </div>
                <!--end logo-->
            </div>
          </span>

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li ><a href="../home/index.php">Home</a></li>
              <li><a href="../../pages/about/about.php">About</a></li>
              <li><a href="../../pages/faq/faq.php">FAQ</a></li>
              <li><a href="../../pages/contact/contact.php">Contact Us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                //if someone is logged in
                if(isset($_SESSION['userID'])) {
                    //Admin center
                    if((($_SESSION['accountType']) == 'Admin') || (($_SESSION['accountType']) == 'Owner')){
                        echo '<li><a href="../admin/admincenter.php"><span class="glyphicon glyphicon-user"></span> Admin Center</a></li>';
                    } 

                    //User center 
                    if ($_SESSION['accountType'] == 'Student' || $_SESSION['accountType'] == 'Teacher' || $_SESSION['accountType'] == 'StudentAndTeacher') {
                         echo '<li><a href="../usercenter/usercenter.php"><span class="glyphicon glyphicon-user"></span> User Center</a></li>';
                    }

                    //Logout
                    echo '<li><a href="../logout/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
                } else {
                    echo '<li><a href="../createAccount/createAccount.php"><span class="glyphicon glyphicon-book"></span> Register</a></li>';
                    echo '<li><a href="../login/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                }
                    
                    
                ?>
            </ul>
          </div>
        </nav>

            <?php if($pagetitle == "About Us | Pinelands Music School"): ?>
              <div class="banner"> <img src="../../images/banners/about.jpg" />
            <?php elseif($pagetitle == "Enrol | Pinelands Music School"): ?>
              <div class="banner"> <img src="../../images/banners/enrol.jpg" />
            <?php elseif($pagetitle == "Contact Us | Pinelands Music School"): ?>
              <div class="banner">
            <?php else: ?>
              <div class="banner"> <img src="../../images/banners/main.jpg" />
            <?php endif ?>
                  </div>
