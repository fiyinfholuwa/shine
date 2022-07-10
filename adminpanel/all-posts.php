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
                    <h4>All Posts</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Post Content</th>
                            <th>Post count</th>
                            <th>Post Category</th>
                            <th>Post Author</th>
                            <th>Post Image</th>
                            <th>Post tag</th>
                            <th>Read time</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                             $post = new Posts();
                            if (isset($_GET['delPost'])) {
                                $id = $_GET['delPost'];
                                $delpost = $post->delPostById($id);
                            }
                           
                           $i=0;
                            $getpost = $post->getAllPosts('post_tbl', 'post_id' );
                            if ($getpost) {
                                while ($result = $getpost->fetch_assoc()) {  $i++ ?>
                      
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['post_title'] ;?></td>
                            <td><?= $result['post_content'] ;?></td>
                            <td><?= $result['post_count'] ;?></td>
                            <td><?php $cat = $result['post_category'] ;
                            $getcat = "select * from category_tbl where cat_id ='$cat' ";
                            $run_cat = mysqli_query($conn, $getcat);
                            $fetch = mysqli_fetch_assoc($run_cat);
                            echo $fetch['cat_name'];
                            ?></td>
                            <td><?= $result['post_author'] ;?></td>
                            <td><img height="40" width="50" src="<?= $result['post_image']; ?>" /></td>
                            <td><?= $result['post_tags'] ;?></td>
                            <td><?= $result['read_time'] ;?> mins</td>
                            
                            <td>
                            <a href="edit-post?edit=<?= $result['post_id'];?>"><i style="padding: 6px; font-size:35px;" class="fas fa-edit "></i></a>
                              <a style="padding: 6px; font-size:25px;" href="?delPost=<?= $result['post_id'];?>"><i class="fa fa-trash text-danger"></i></a>
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