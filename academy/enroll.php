<?php include "helper/header.php"; ?>
  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider parallax layer-overlay overlay-dark-3" data-bg-img="images/3.jpg">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                
                <div class="bg-lightest border-1px p-30 mb-0">
                  <h3 class="text-theme-colored mt-0 pt-5">Enrollment Form</h3>
                  <hr>
                  <?php 
                $contact = new ContactUs();

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
                    
                    $full_name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $nationality = $_POST['nationality'];
                    $state = $_POST['state'];
                    

                    $insertContact = $contact->InsertEnroll($full_name, $email, $phone, $address, $nationality, $state);
                }

                ?>
                  <form  name="job_apply_form" action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Full Name <small>*</small></label>
                          <input name="name" type="text" placeholder="Enter Name" required="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Email <small>*</small></label>
                          <input name="email" class="form-control required email" type="email" placeholder="Enter Email">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Phone Number<small>*</small></label>
                          <input name="phone" type="text" placeholder="Phone Number" required="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Location/Address<small>*</small></label>
                          <input name="address" class="form-control required " type="text" placeholder="Location/Address">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Nationality<small>*</small></label>
                          <input name="nationality" type="text" placeholder="Nationality" required="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>State<small>*</small></label>
                          <input name="state" class="form-control required email" type="text" placeholder="State">
                        </div>
                      </div>
                    </div>
                    
                    
                  
                    <div class="form-group">
                      <input name="form_botcheck" class="form-control" type="hidden" value="" />
                      <button type="submit" name="send_msg" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" >Apply Now</button>
                    </div>
                  </form>
                  <!-- Job Form Validation-->
                  <script type="text/javascript">
                    $("#job_apply_form").validate({
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
          </div>
        </div>
      </div>
    </section> 
  </div>  
  <!-- end main-content -->
<style>
    small{
        color: red;
        font-weight: 700;
        font-size: 20px;
    }
</style>
  <!-- Footer -->
  <footer id="footer" class="footer bg-black-222">
    
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="js/custom.js"></script>
<script src="../adminpanel/assets/js/toastr.min.js"></script>
<script>
    <?php if(isset($_SESSION['success'])): ?>
      toastr.options = {
  "closeButton": true,

  "progressBar": true,
  
  "preventDuplicates": false,
  "showDuration": "1000",
  "hideDuration": "1000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
      toastr.success("<?= Flash('success'); ?>");
    <?php endif ?>
    <?php if(isset($_SESSION['error']) ): ?>
      toastr.error("<?= Flash('error'); ?>");

    <?php endif ?>
  </script>
</body>

<!-- form-job-apply-style217:17-->
</html>