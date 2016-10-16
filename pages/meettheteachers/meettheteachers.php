<?php
$pagetitle = "Meet our Teachers";
include "../../inc/connect.php";
include "../../inc/header.php";
include "../../inc/nav.php";
?>
<div class="content centered">
    <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../about/about.php">About</a> > Meet the Teachers</span>
        </div>
<h1>Pinelands Teachers</h1>
<?php
  include "../../inc/ourTeachers.php";
?>

</div>

<?php
include "../../inc/footer.php";
?>
