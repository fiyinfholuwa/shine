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

                $category = new Category();
                   if (isset($_POST['new_cat'])) {
                       $cat_name = $_POST['cat_name'];
                       $insertcat = $category->InsertCategory($cat_name);
                   }
                 ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="">
                    <div class="card-header">
                      <h4>Add Audio</h4>
                    </div>
                    <div class="card-body">
                    <p style="color: green;" class="text-center pb-3">
                      <?php if (isset($insertcat)) {
                                  echo $insertcat;
                          }
                            ?>
                                </p>
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="cat_name" required="">
                        <div class="invalid-feedback">
                          Input  Post Category
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_cat" value="Add Category"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>