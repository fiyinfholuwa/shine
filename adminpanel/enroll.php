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
                    <h4>Enroll- messages</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Nationality</th>
                            <th>State</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if (isset($_GET['delMessage'])) {
                        $id = $_GET['delMessage'];
                        $delMessage = "delete from enroll_tbl where enroll_id ='$id'";
                        $run_del = mysqli_query($conn, $delMessage);
                        if ($run_del) {
                            echo "<script>
                            setTimeout(function(){
                               window.location.href = 'enroll';
                            }, 1500);
                         </script>";	
                        Flash("success",  "message deleted successfully"); 
                        }
                        }
                        $i=0;
                        $query = "select * from enroll_tbl";
                        $run_query = mysqli_query($conn, $query);
                        while($result = mysqli_fetch_assoc($run_query)){ 
                            $i++;
                            ?>

                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['full_name']; ?></td>
                           <td><?= $result['email']; ?></td>
                           <td><?= $result['phone']; ?></td>
                           <td><?= $result['address']; ?></td>
                           <td><?= $result['nationality']; ?></td>
                           <td><?= $result['state']; ?></td>
                           
                             <td> <a style="padding: 6px; font-size:25px;" href="?delMessage=<?= $result['enroll_id'];?>"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                            
                          </tr>
                          <?php }  ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       

<?php include "helper/footer.php" ?>