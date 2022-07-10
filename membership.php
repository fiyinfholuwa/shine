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
              <?php 
                if(isset($_POST['new_member'])){
              $full_name = mysqli_escape_string($conn, $_POST['full_name']);
              $email   = mysqli_escape_string($conn, $_POST['email']);
              $date_of_birth   = mysqli_escape_string($conn,$_POST['date_of_birth']);
              $location   = mysqli_escape_string($conn, $_POST['location']);
              $occupation   = mysqli_escape_string($conn,$_POST['occupation']);
              $telephone   = mysqli_escape_string($conn, $_POST['telephone']);
              $sex   = mysqli_escape_string($conn, $_POST['sex']);
              $born_again   = mysqli_escape_string($conn,$_POST['born_again']);
              $baptism   = mysqli_escape_string($conn, $_POST['baptism']);
              $about_us   = mysqli_escape_string($conn, $_POST['about_us']);
              $our_service   = mysqli_escape_string($conn, $_POST['our_service']);
              
              if ($full_name== "" || $email == "" || $date_of_birth=="" || $location=="" || $occupation=="" || $telephone=="" || $sex==""|| $born_again=="" || $baptism=="" || $about_us=="" || $our_service=="") {
                // echo "<script>alert('Fill in the empty space')</script>";
                Flash("error",  "Fill in the empty space");
              }else{
                
                $query = "insert into membership(full_name, email, date_of_birth, location, occupation, telephone, sex, born_again, baptism, about_us, our_service) values('$full_name','$email', '$date_of_birth', '$location', '$occupation', '$telephone', '$sex', '$born_again', '$baptism', '$about_us', '$our_service' ) ";
                $run_query = mysqli_query($conn, $query);
                if ($run_query) {
                  echo "<script>
                    setTimeout(function(){
                       window.location.href = 'membership';
                    }, 3000);
                 </script>";
                Flash("success",  "you have successfully registered, thank you for your time.");
                } else {
                    Flash("error",  "data not inserted ");
                }
                
                
                
              }

        } 
            

                ?>
                <div class="bg-lightest border-1px p-30 mb-0">
                  <h3 class="text-theme-colored mt-0 pt-5">Membership Form</h3>
                  <hr>
                  
                  <form  action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Full Name <small>*</small></label>
                          <input name="full_name" type="text" placeholder="Enter Name"  class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Email <small>*</small></label>
                          <input name="email" class="form-control email" type="email" placeholder="Enter Email">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Date of Birth<small>*</small></label>
                          <input name="date_of_birth" type="date" placeholder="Date Of Birth" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Location/Address<small>*</small></label>
                          <input name="location" class="form-control  email" type="text" placeholder="Location/Address">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Occupation<small>*</small></label>
                          <input name="occupation" type="text" placeholder="Occupation" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Telephone<small>*</small></label>
                          <input name="telephone" class="form-control  email" type="text" placeholder="Phone Number">
                        </div>
                      </div>
                    </div>
                    <div class="row">               
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Gender<small>*</small></label>
                          <select name="sex" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Are you Born Again<small>*</small></label>
                          <select name="born_again" class="form-control required">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Have you done Water Baptism by immersion<small>*</small></label>
                          <select name="baptism" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>How do you get to know about us<small>*</small></label>
                          <select name="about_us" class="form-control required">
                            <option value="friend">Friend</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Whatsapp">Whatsapp</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>What do you like about our services</label> <small>*</small></label>
                      <textarea name="our_service" class="form-control" rows="5" placeholder="What do you like about our services"></textarea>
                    </div>
                  
                    <div class="form-group">
                     
                      <button type="submit" name="new_member" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" >Apply Now</button>
                    </div>
                  </form>
                  
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
<script src="adminpanel/assets/js/toastr.min.js"></script>
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