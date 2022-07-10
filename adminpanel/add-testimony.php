<?php include "helper/header.php"; ?>
      <?php include "helper/sidebar.php"; ?>
      <!-- Main Content -->
    <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
               
            <?php 
                $test = new Testimony();
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_test'])) {
                  
                    $insertTestimony = $test->AddTestimony($_POST, $_FILES);
                }
             ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Add Testimony</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>Ful Name:</label>
                        <input type="text" class="form-control" name="full_name" required="">
                        <div class="invalid-feedback">
                          Input  Full Name
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Content:</label>
                        <input type="text" class="form-control" name="content" required="">
                        <div class="invalid-feedback">
                          Add testimony Content
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Occupation:</label>
                        <input type="text" class="form-control" name="role" required="">
                        <div class="invalid-feedback">
                          Add Occupation
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Testimonial Image:</label>
                        <input type="file" class="form-control" name="test_image" required="">
                        <div class="invalid-feedback">
                          Add Award Image
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_test" value="Add Testimony"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>