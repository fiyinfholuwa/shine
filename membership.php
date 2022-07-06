<?php include "helper/header.php"; ?>
  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider parallax layer-overlay overlay-dark-3" data-bg-img="images/bg2.jpg">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                
                <div class="bg-lightest border-1px p-30 mb-0">
                  <h3 class="text-theme-colored mt-0 pt-5">Membership Form</h3>
                  <hr>
                  
                  <form id="job_apply_form" name="job_apply_form" action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Name <small>*</small></label>
                          <input name="form_name" type="text" placeholder="Enter Name" required="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Email <small>*</small></label>
                          <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Date of Birth<small>*</small></label>
                          <input name="form_name" type="date" placeholder="Date Of Birth" required="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Location/Address<small>*</small></label>
                          <input name="form_email" class="form-control required email" type="text" placeholder="Location/Address">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Occupation<small>*</small></label>
                          <input name="form_name" type="text" placeholder="Occupation" required="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Telephone<small>*</small></label>
                          <input name="form_email" class="form-control required email" type="number" placeholder="Phone Number">
                        </div>
                      </div>
                    </div>
                    <div class="row">               
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Sex <small>*</small></label>
                          <select name="form_sex" class="form-control required">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Are you Born Again<small>*</small></label>
                          <select name="form_post" class="form-control required">
                            <option value="Finance Manager">Yes</option>
                            <option value="Area Manager">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Have you done Water Baptism by immersion<small>*</small></label>
                          <select name="form_post" class="form-control required">
                            <option value="Finance Manager">Yes</option>
                            <option value="Area Manager">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>How do you get to know about us<small>*</small></label>
                          <select name="form_post" class="form-control required">
                            <option value="Finance Manager">Friend</option>
                            <option value="Area Manager">Social Media</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>What do you like about our services</label> <small>*</small></label>
                      <textarea name="form_message" class="form-control required" rows="5" placeholder="What do you like about our services"></textarea>
                    </div>
                  
                    <div class="form-group">
                      <input name="form_botcheck" class="form-control" type="hidden" value="" />
                      <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Apply Now</button>
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

</body>

<!-- form-job-apply-style217:17-->
</html>