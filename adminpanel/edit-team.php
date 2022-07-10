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
                if (!isset($_GET['id']) || $_GET['id'] == NULL) {
                    echo "<script>window.location = 'all-team'</script>";
                }else{
                    $id = $_GET['id'];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_team'])) {


                    $edit_team = $team->UpdateTeam($_POST, $_FILES, $id);
                }

                 ?>
                 <?php
                $team_id = $id;
               
                 $getTeam= "select * from team_tbl where team_id ='$team_id' ";
                 $run_query = mysqli_query($conn, $getTeam);
                 $result = mysqli_fetch_array($run_query); ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Update Board Of Trustee</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" value="<?= $result['full_name']; ?>" name="full_name" required="">
                        <div class="invalid-feedback">
                          Input  full name
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Role/Position:</label>
                        <input type="text" class="form-control" value="<?= $result['role']; ?>" name="role" required="">
                        <div class="invalid-feedback">
                          Input role / position
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Image:</label>
                        <input type="file" class="form-control" name="team_image">
                        <img height="40" width="50" src="<?= $result['team_image']; ?>" />
                        <div class="invalid-feedback">
                          Add image
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="update_team" value="Update Team"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>