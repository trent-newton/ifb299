<?php
    $pagetitle = "Enrol | Pinelands Music School";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
?>

<div class="content">

    <h1>You're just a few steps away from joining us!</h1>
    <h1>Read our checklist carefully to understand how to complete your enrolment</h1><br>
    <div class="enrolmentChecklist">
      <span><img src="../images/enrolment/one.png"/><div class="enrolmentChecklistText">Get your paperwork ready</div></span>
    </div><br>
    <div class="enrolmentChecklist">
      <span><img src="../images/enrolment/two.png"/><div class="enrolmentChecklistText">Enter your details</div></span>
    </div><br>
    <div class="enrolmentChecklist">
      <span><img src="../images/enrolment/three.png"/><div class="enrolmentChecklistText">Choose your instrument and availability</div></span>
    </div><br>

      <div class="enrolButtonContainer"><div class="enrolButton"><div class="enrolButtonSquare"><a href="../pages/enrol.php" class="enrolButton">ENROL</a></div></div></div>

</div>








<!--end content-->
<?php
include "../inc/footer.php";
?>
