<?php include "helper/header.php"; ?>
      <?php include "helper/sidebar.php"; ?>
      <!-- Main Content -->
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Category</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Category Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                         $getcategory = new Category();
                        if (isset($_GET['DelCategory'])) {
                            $id = $_GET['DelCategory'];
                            $delMessage = $getcategory->delCategoryById($id);
                        }
                        
                          $i=0;
                          $getCat = $getcategory->getCategory('category_tbl', 'cat_id');
                          if ($getCat) {
                              while ($result = $getCat->fetch_assoc()) {
                               $i++; ?>
                      
                       
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['cat_name'] ;?></td>
                            <td>
                            <a href="edit-category?id=<?= $result['cat_id'];?>"><i  style="padding: 6px; font-size:35px;" class="fas fa-edit "></i></a>
                              <a style="padding: 6px; font-size:25px;" href="?DelCategory=<?= $result['cat_id'];?>"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                            
                          </tr>
                          <?php } } ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       

<?php include "helper/footer.php" ?>