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
                    <h4>All Board Of Trustees</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th> Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                         $team = new Team();
                        if (isset($_GET['delTeam'])) {
                            $id = $_GET['delTeam'];
                            $delMessage = $team->delTeamById($id);
                        }
                        
                          $i=0;
                          $getTeam = $team->getAllTeam('team_tbl', 'team_id');
                          if ($getTeam) {
                              while ($result = $getTeam->fetch_assoc()) {
                               $i++; ?>
                      
                       
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['full_name']; ?></td>
                           <td><?= $result['role']; ?></td>
                           <td><img height="40" width="50" src="<?= $result['team_image'] ?>" /></td>
                            <td>
                            <a  href="edit-team?id=<?= $result['team_id'];?>"><i style="padding: 6px; font-size:25px;" class="fas fa-edit"></i></a>
                              <a style="padding: 6px; font-size:25px;" href="?delTeam=<?= $result['team_id'];?>"><i class="fa fa-trash text-danger"></i></a>
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