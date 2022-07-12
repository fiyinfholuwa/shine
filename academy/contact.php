<?php include "helper/header.php"; ?>
  
  <!-- Start main-content -->
  <div class="main-content bg-lighter">
    <!-- Section: inner-header -->
    

    <!-- Divider: Contact -->
    <section class="divider">
      <div class="container pt-0">
        <div class="row mb-60 bg-deep">
          <div class="col-sm-12 col-md-4">
            <div class="contact-info text-center pt-60 pb-60 border-right">
              <i class="fa fa-phone font-36 mb-10 text-theme-colored"></i>
              <h4>Call Us</h4>
              <h6 class="text-gray">Phone: 07036736994</h6>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="contact-info text-center  pt-60 pb-60 border-right">
              <i class="fa fa-map-marker font-36 mb-10 text-theme-colored"></i>
              <h4>Address</h4>
              <h6 class="text-gray">First campus @ Akure, Ondo state</h6>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="contact-info text-center  pt-60 pb-60">
              <i class="fa fa-envelope font-36 mb-10 text-theme-colored"></i>
              <h4>Email</h4>
              <h6 class="text-gray">you@yourdomain.com</h6>
            </div>
          </div>
        </div>
        <div class="row pt-10">
          <div style="overflow: hidden;" class="col-md-5">
          <h4 class="mt-0 mb-30 line-bottom">Find Our Location</h4>
          <!-- Google Map HTML Codes -->
          
          <div style="" class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=First%20campus%20@%20Akure,%20Ondo%20state&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org">123movies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
        
          
          
          </div>
          <div class="col-md-7">
            <h4 class="mt-0 mb-30 line-bottom">Get In Touch</h4>
            <?php 
                $contact = new ContactUs();

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
                    
                    $full_name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $message = $_POST['message'];
                    

                    $insertContact = $contact->InsertContact($full_name, $email, $phone, $message);
                }

                ?>
            <!-- Contact Form -->
            <form  name="contact_form" class="" action="#" method="post">

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_name">Name <small>*</small></label>
                    <input name="name" class="form-control" type="text" placeholder="Enter Name" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email <small>*</small></label>
                    <input name="email" class="form-control required email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>                
              <div class="row">
                
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="form_phone">Phone</label>
                    <input name="phone" class="form-control" type="text" placeholder="Enter Phone" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="form_name">Message</label>
                <textarea name="message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
              </div>
              <div class="form-group">
                <input name="form_botcheck" class="form-control" type="hidden" value="" />
                <button type="submit" name="send_msg" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" >Send your message</button>
                
              </div>
            </form>

            <!-- Contact Form Validation-->
            <script type="text/javascript">
              $("#contact_form").validate({
                submitHandler: function(form) {
                  var form_btn = $(form).find('button[type="submit"]');
                  var form_result_div = '#form-result';
                  $(form_result_div).remove();
                  form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                  var form_btn_old_msg = form_btn.html();
                  form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                  $(form).ajaxSubmit({
                    dataType:  'json',
                    success: function(data) {
                      if( data.status == 'true' ) {
                        $(form).find('.form-control').val('');
                      }
                      form_btn.prop('disabled', false).html(form_btn_old_msg);
                      $(form_result_div).html(data.message).fadeIn('slow');
                      setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                    }
                  });
                }
              });
            </script>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
  
  <?php include "helper/footer.php"; ?>