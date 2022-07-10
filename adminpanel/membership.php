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
                    <h4>Membership Feedback</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" >
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Location</th>
                            <th>Occupation</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th>Born Again Status</th>
                            <th>Baptism Status</th>
                            <th>How you know about us</th>
                            <th>What you like about our service</th>
                           
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if (isset($_GET['delMessage'])) {
                        $id = $_GET['delMessage'];
                        $delMessage = "delete from membership where membership_id ='$id'";
                        $run_del = mysqli_query($conn, $delMessage);
                        if ($run_del) {
                            echo "<script>
                            setTimeout(function(){
                               window.location.href = 'membership';
                            }, 1500);
                         </script>";	
                        Flash("success",  "message deleted successfully"); 
                        }
                        }
                        $i=0;
                        $query = "select * from membership";
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
                           <td><?= $result['date_of_birth']; ?></td>
                           <td><?= $result['location']; ?></td>
                           <td><?= $result['occupation']; ?></td>
                           <td><?= $result['telephone']; ?></td>
                           <td><?= $result['sex']; ?></td>
                           <td><?php $status= $result['born_again']; 
                           if ($status == 'Yes') { ?>
                            <span class="btn btn-success">Yes</span>
                          <?php  } else { ?>
                            <span class="btn btn-warning">No</span> 
                          <?php }
                           
                           ?></td>
                           <td><?php $status=  $result['baptism']; 
                           if ($status == 'Yes') { ?>
                            <span class="btn btn-success">Yes</span>
                          <?php  } else { ?>
                            <span class="btn btn-warning">No</span> 
                          <?php }
                           ?></td>
                           <td><?= $result['about_us']; ?></td>
                           <td><?= $result['our_service']; ?></td>
                           
                             <td> <a style="padding: 6px; font-size:25px;" href="?delMessage=<?= $result['membership_id'];?>"><i class="fa fa-trash text-danger"></i></a>
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