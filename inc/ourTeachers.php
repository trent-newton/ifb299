<?php
  $sql = 'SELECT * FROM users WHERE accountType="Teacher" OR accountType="StudentAndTeacher" ';
  $result = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($result)) {
      echo "<div class='common teacherPage'>";
    echo "<h2>" . $row['firstName'] . "<br />" . $row['lastName'] . "</h2>";

    $userID = $row["UserID"];

    $sql4 = "SELECT * FROM teacherreviews WHERE teacherreviews.teacherID = '$userID' AND reviewStatus = 'Public'";
    $result4 = mysqli_query($con, $sql4);
    $totalRating = 0;
    $count = 0;
    while ($row4 = mysqli_fetch_array($result4)) {
      $totalRating = $totalRating + $row4['reviewRating'];
      $count = $count + 1;
    }
    if ($count > 0) {
    $averagedRating = $totalRating / $count;

    echo '<script type="text/javascript">
    $(function(){
       var ratings=[';
    echo $averagedRating;
    echo'];
        $.each(ratings,function(){
            $("#star_rating")
                .removeAttr("id")
                .width(70*(this/5))
        });
    });
    </script>';

    echo '<div id="rating">
       <div id="star_rating" style="overflow:hidden;width:70px">
           <img src="../../images/about/five_stars.png" style="width:70px;height:auto"/> <!-- width:260px;height:49px -->
       </div>
   </div>';
   }

    $sql2 = "SELECT * FROM languages WHERE languages.userID = '$userID'";
    $result2 = mysqli_query($con, $sql2);
    echo "<strong>Languages I speak: </strong>";
      echo "<ul>";
    while ($row2 = mysqli_fetch_array($result2)) {
      echo "<li>".$row2['language']."</li>";
    }
      echo "</ul>";


    $sql3 = "SELECT instrumentName FROM users LEFT JOIN userinstrument ON users.UserID=userinstrument.userID LEFT JOIN instrumentnames ON userinstrument.InstrumentTypeID=instrumentnames.instrumentTypeID  WHERE users.UserID = '$userID'";
    $result3 = mysqli_query($con, $sql3);
    echo "<strong>Instruments you can learn to play from me: </strong>";
      echo "<ul>";
    while ($row3 = mysqli_fetch_array($result3)) {
      echo "<li>".$row3['instrumentName']."</li>";
    }
      echo "</ul>";
echo "<a href='https://www.facebook.com/";
echo $row['facebookId'];
echo "'><img class='about_icon' src='../../images/socialMedia/facebook.png' alt='Facebook Link'></a>";
echo "<a href='mailto:";
echo $row['email'];
echo "'><img class='mail_icon' src='../../images/socialMedia/mail.png' alt='e-Mail Link'></a>";
echo "</div>";
}
?>
