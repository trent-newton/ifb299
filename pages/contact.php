<?php
    $pagetitle = "Contact Us | Pinelands Music School";
    include "../inc/connect.php";
    include "../inc/header.php";
    include "../inc/nav.php";
?>
    <div class="content">
        <h1>Contact Us</h1>
        <form action="../inc/contact_form_processing.php">

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
    </div>
    <!--end content-->
<?php
    include "../inc/footer.php";
?>
