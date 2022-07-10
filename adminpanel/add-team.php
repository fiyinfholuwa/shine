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
                $team = new Team();
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_team'])) {
                  
                    $insertTeam = $team->AddTeam($_POST, $_FILES);
                }
             ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Add Board Of Trustee</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" name="full_name" required="">
                        <div class="invalid-feedback">
                          Input  full name
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Role/Position:</label>
                        <input type="text" class="form-control" name="role" required="">
                        <div class="invalid-feedback">
                          Input role / position
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Image:</label>
                        <input type="file" class="form-control" name="team_image" required="">
                        <div class="invalid-feedback">
                          Add image
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_team" value="Add Team"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>