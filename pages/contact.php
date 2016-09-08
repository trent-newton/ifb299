<?php
    $pagetitle = "Contact Us | Pinelands Music School";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
?>
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDX-FOv5xJ96b9kiz59Vgimpeod6xolriU&callback=initMap'>
  </script>

    <div class="contactMap" id='gmap_canvas'>
    </div>

  <script type='text/javascript'>
  function init_map()
  {
    var myOptions = {
      zoom:15,
      center:new google.maps.LatLng(-27.4756149,153.0280444999996),
      scrollwheel: false,
      navigationControl: false,
      mapTypeControl: false,
      scaleControl: false,
      draggable: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP};
      map = new google.maps.Map(document.getElementById('gmap_canvas'),myOptions);
      marker = new google.maps.Marker(
        {

          map: map,position: new google.maps.LatLng(-27.4756149,153.02804449999996)});
          infowindow = new google.maps.InfoWindow({content:'<strong>Pinelands Music School</strong><br>1 George St, Brisbane 4000<br>'});
          google.maps.event.addListener(marker, 'click', function()
          {
            infowindow.open(map,marker);});
            infowindow.open(map,marker);
          }
          google.maps.event.addDomListener(window, 'load', init_map);

  </script>

    <div class="content contactUs">
        <h1>Contact Us</h1>

        <form action="../inc/contact_form_processing.php" style="display:inline-block;padding-right:40px;">

          <label class="control-label" for="first_name">First Name <span class="required">*</span></label>
          <div class="controls">
            <input name="first_name" id="first_name" placeholder="John" required>
          </div>

          <label class="control-label" for="last_name">Last Name <span class="required">*</span></label>
          <div class="controls">
            <input name="last_name" id="last_name" placeholder="Appleseed" required>
          </div>

          <div class="control-group">
            <label class="control-label" for="email">Email <span class="required">*</span></label>
            <div class="controls">
              <input name="email" type="email" id="email" placeholder="email@address.com" required>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="message">Message <span class="required">*</span></label>
            <div class="controls">
              <textarea rows="5" name="message" id="message" required></textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-large">Send</button>

        </form>

        <div class="contactDetails">
          <h2>Call Us</h2>
          <p>1300 321 456</p>
          <h3>Opening Hours</h3>
          <p>Monday - Friday: 8:00am - 8:00pm</p>
          <p>Saturday - Sunday: 10:00am - 5:00pm</p>
          <h3>Emergency Contact</h3>
          <p>Mika: 0423 456 124</p>
        </div>
    </div>
    <!--end content-->
<?php
    include "../inc/footer.php";
?>
