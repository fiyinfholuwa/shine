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
                    <h4>All Testimonials</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Full name</th>
                            <th>Content</th>
                            <th>Role</th>
                            <th>Testimonial Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                         $test = new Testimony();
                        if (isset($_GET['delTest'])) {
                            $id = $_GET['delTest'];
                            $delMessage = $test->delTestimonyById($id);
                        }
                        
                          $i=0;
                          $getTest = $test->getAllTestimony('testimony_tbl', 'test_id');
                          if ($getTest) {
                              while ($result = $getTest->fetch_assoc()) {
                               $i++; ?>
                      
                       
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['full_name']; ?></td>
                           <td><?= $result['content']; ?></td>
                           <td><?= $result['role']; ?></td>
                           <td><img height="40" width="50" src="<?= $result['test_image'] ?>" /></td>
                            <td>
                            <a  href="edit-testimony?id=<?= $result['test_id'];?>"><i style="padding: 6px; font-size:25px;" class="fas fa-edit"></i></a>
                              <a style="padding: 6px; font-size:25px;" href="?delTest=<?= $result['test_id'];?>"><i class="fa fa-trash text-danger"></i></a>
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