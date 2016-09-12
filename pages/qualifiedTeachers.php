<?php
    $pagetitle = "Qualified Teachers | Pinelands Music School";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
?>

    <div class="content">
        <h1>Qualified Teachers</h1>
        <p>Our teachers are qualified music teachers, and collectivally we can speak several languages and know how to play a wide range or musical instruments at a professional level.
        Each teacher provides unquie skills to our community, and we welcome you to get to know them below.</p>
        <?php
          include "../inc/ourTeachers.php";
        ?>
    </div>
    <!--end content-->
<?php
    include "../inc/footer.php";
?>
