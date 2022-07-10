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
                if (!isset($_GET['id']) || $_GET['id'] == NULL) {
                    echo "<script>window.location = 'all-testimonial'</script>";
                }else{
                    $id = $_GET['id'];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_test'])) {


                    $edit_test = $test->UpdateTestimony($_POST, $_FILES, $id);
                }

                 ?>
                 <?php
                $test_id = $id;
               
                 $getTest= "select * from testimony_tbl where test_id ='$test_id' ";
                 $run_query = mysqli_query($conn, $getTest);
                 $result = mysqli_fetch_array($run_query); ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Update Testimony</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>Ful Name:</label>
                        <input type="text" class="form-control" name="full_name" value="<?= $result['full_name']; ?>" required="">
                        <div class="invalid-feedback">
                          Input  Full Name
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Content:</label>
                        <input type="text" class="form-control" name="content" value="<?= $result['content']; ?>" required="">
                        <div class="invalid-feedback">
                          Add testimony Content
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Occupation:</label>
                        <input type="text" class="form-control" name="role" value="<?= $result['role']; ?>" required="">
                        <div class="invalid-feedback">
                          Add Occupation
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Testimonial Image:</label>
                        <input type="file" class="form-control" name="test_image" >
                        <img height="40" width="50" src="<?= $result['test_image']; ?>" />
                        <div class="invalid-feedback">
                          Add Testimony Image
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="update_test" value="Update Testimony"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>