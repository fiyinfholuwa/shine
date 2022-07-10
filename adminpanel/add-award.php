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
                $award = new Award();
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_award'])) {
                  
                    $insertaward = $award->AddAward($_POST, $_FILES);
                }
             ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Add Award</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>Award Title:</label>
                        <input type="text" class="form-control" name="award_title" required="">
                        <div class="invalid-feedback">
                          Input  Award title
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Organization:</label>
                        <input type="text" class="form-control" name="organization" required="">
                        <div class="invalid-feedback">
                          Add organization
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Award Image:</label>
                        <input type="file" class="form-control" name="award_image" required="">
                        <div class="invalid-feedback">
                          Add Award Image
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_award" value="Add Award"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>