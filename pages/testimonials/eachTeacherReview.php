<?php
// Get selected userID
$userID = $_GET['userID'];
    $pagetitle = "Our Teachers Testimonials | Pinelands Music School";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
?>

 <div class="content ">
    <h1 class="centered">Testimonials About
      <?php
      $sql2 = "SELECT users.firstName, users.lastName FROM users WHERE users.userID = $userID";
      $result2 = mysqli_query($con, $sql2);
      while ($row = mysqli_fetch_array($result2)) {
        echo $row["firstName"];
        echo " ";
        echo $row["lastName"];
      }
      ?>
    </h1>

<?php
$sql = "SELECT teacherreviews.*,users.firstName, users.lastName FROM users INNER JOIN teacherreviews ON users.userID = teacherreviews.teacherID WHERE teacherreviews.teacherID = $userID";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) {
  if ($row["reviewStatus"] == 'Public') {
    echo '<div class="faq_post">
					<div class="faq_copy">
						<div class="padding">
						<h2 class="faq_title">';
            echo $row["reviewComment"];
            echo "<br>";
            $ratingStars = $row["reviewRating"];
            echo '<script type="text/javascript">
            $(function(){
               var ratings=[';
            echo $ratingStars;
            echo'];
                $.each(ratings,function(){
                    $("#star_rating")
                        .removeAttr("id")
                        .width(120*(this/5))
                });
            });
            </script>';

            echo '<div id="rating">
               <div id="star_rating" style="overflow:hidden;width:120px">
                   <img src="../../images/about/five_stars.png" style="width:120px;height:auto"/> <!-- width:260px;height:49px -->
               </div>
           </div>';
            echo '</h2>
						</div>
					</div>
				</div>';
        }
      }
 ?>
</div>
    <!--end content-->
<?php
    include "../../inc/footer.php";
?>
