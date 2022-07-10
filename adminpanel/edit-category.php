<?php include "helper/header.php"; ?>
      <?php include "helper/sidebar.php"; ?>
      <!-- Main Content -->
    <!-- Main Content -->
    <?php 
    $category = new Category();

        if (!isset($_GET['id']) || $_GET['id'] == NULL) {
            echo "<script>window.location = 'all-category'</script>";
        }else{
            $id = $_GET['id'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $cat_name = $_POST['cat_name'];
            

            $Updatecat = $category->UpdateCat($cat_name, $id);
        }


        ?>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
              
                <div class="card">
                <?php
                    $getCat= $category->getCategoryById($id);
                if ($getCat){
                    while ($result= $getCat->fetch_assoc()) { ?>
               
                
                  <form class="needs-validation" action="" method="post" novalidate="">
                    <div class="card-header">
                      <h4>Update Category</h4>
                    </div>
                    <div class="card-body">
                    <p style="color: green;" class="text-center pb-3">
                      
                                </p>
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" value="<?= $result['cat_name']; ?>" name="cat_name" required="">
                        
                        <div class="invalid-feedback">
                          Input  Post Category
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_cat" value="Update Category"/>
                    </div>
                  </form>
                  <?php } } ?>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>