<?php
// Get selected teacherID
$teacherID = $_GET['userID'];
    $pagetitle = "Our Teachers Testimonials | Pinelands Music School";
    include "../../inc/connect.php";
    include "../../inc/header.php";
    include "../../inc/nav.php";
      $sql2 = "SELECT users.firstName, users.lastName FROM users WHERE users.userID = $teacherID";
      $result2 = mysqli_query($con, $sql2);
      while ($row2 = mysqli_fetch_array($result2)) {
        $teacherName = $row2["firstName"];
        
        $teacherName .= " " . $row2["lastName"];
      }
    

?>

 <div class="content ">
     <div class="breadcrumb">
            <span><a href="../home/index.php">Home</a> > <a href="../testimonials/testimonials.php">Testimonials</a> >  <?php echo $teacherName?></span>
        </div>
    <h1 class="centered">Testimonials About <?php echo $teacherName?></h1>

<?php
$sql = "SELECT teacherreviews.*,users.firstName, users.lastName FROM users INNER JOIN teacherreviews ON users.userID = teacherreviews.teacherID WHERE teacherreviews.teacherID = $teacherID";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) {
  //Shows only reviews with a Public status
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
