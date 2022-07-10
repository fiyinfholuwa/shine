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
                    <h4>All Audios</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Audio Title</th>
                            <th>Audio Content</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                         $audio = new Audio();
                        if (isset($_GET['delAudio'])) {
                            $id = $_GET['delAudio'];
                            $delMessage = $audio->delAudioById($id);
                        }
                        
                          $i=0;
                          $getAudio = $audio->getAllAudio('audio_tbl', 'audio_id');
                          if ($getAudio) {
                              while ($result = $getAudio->fetch_assoc()) {
                               $i++; ?>
                      
                       
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['audio_title'] ;?></td>
                            <td><audio  controls>
                           <source src="<?= $result['uploaded_audio']; ?>"/>
                        </audio></td>
                            <td>
                            
                              <a style="padding: 6px; font-size:25px;" href="?delAudio=<?= $result['audio_id'];?>"><i class="fa fa-trash text-danger"></i></a>
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