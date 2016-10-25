<?php
    $pagetitle = "Testimonials | Pinelands Music School";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
?>
 <div class="content ">
    <h1 class="centered">Testimonials</h1>

<?php
  $sql = "SELECT teacherreviews.*,users.firstName, users.lastName FROM users INNER JOIN teacherreviews ON users.userID = teacherreviews.teacherID";
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
               <div id="star_rating" class="starRatingOverflow">
                   <img src="../../images/about/five_stars.png" class="starImage"/>
               </div>
           </div>';
            echo '</h2>
						<p>Review of ';
            echo $row["firstName"];
            echo " ";
            echo $row["lastName"];
            echo '<br />
							<a class="faq_readmore" href="eachTeacherReview.php?userID='.$row['teacherID'].'">More reviews on this Teacher...</a>
						</p>
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
