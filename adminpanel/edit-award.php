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
                if (!isset($_GET['id']) || $_GET['id'] == NULL) {
                    echo "<script>window.location = 'all-awards'</script>";
                }else{
                    $id = $_GET['id'];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_award'])) {


                    $edit_award = $award->UpdateAward($_POST, $_FILES, $id);
                }

                 ?>
                 <?php
                $award_id = $id;
               
                 $getAward= "select * from award_tbl where award_id ='$award_id' ";
                 $run_query = mysqli_query($conn, $getAward);
                 $result = mysqli_fetch_array($run_query); ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Update Award</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>Award Title:</label>
                        <input type="text" class="form-control" value="<?= $result['award_title']; ?>"  name="award_title" required="">
                        <div class="invalid-feedback">
                          Input  Award title
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Organization:</label>
                        <input type="text" class="form-control" value="<?= $result['award_org']; ?>" name="organization" required="">
                        <div class="invalid-feedback">
                          Add organization
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Award Image:</label>
                        <input type="file" class="form-control" name="award_image">
                        <img height="40" width="50" src="<?= $result['award_image']; ?>" />
                        <div class="invalid-feedback">
                          Add Award Image
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="update_award" value="Update Award"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>