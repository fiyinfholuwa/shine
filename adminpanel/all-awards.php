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
                    <h4>All Awards</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Award Title</th>
                            <th>Organization</th>
                            <th>Award Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                         $award = new Award();
                        if (isset($_GET['delAward'])) {
                            $id = $_GET['delAward'];
                            $delMessage = $award->delAwardById($id);
                        }
                        
                          $i=0;
                          $getAward = $award->getAward('award_tbl', 'award_id');
                          if ($getAward) {
                              while ($result = $getAward->fetch_assoc()) {
                               $i++; ?>
                      
                       
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['award_title']; ?></td>
                           <td><?= $result['award_org']; ?></td>
                           <td><img height="40" width="50" src="<?= $result['award_image'] ?>" /></td>
                            <td>
                            <a  href="edit-award?id=<?= $result['award_id'];?>"><i style="padding: 6px; font-size:25px;" class="fas fa-edit"></i></a>
                              <a style="padding: 6px; font-size:25px;" href="?delAward=<?= $result['award_id'];?>"><i class="fa fa-trash text-danger"></i></a>
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