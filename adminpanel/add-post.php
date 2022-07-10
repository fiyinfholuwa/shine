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
                $post = new Posts();
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_post'])) {
                  
                    $insertPost = $post->AddPost($_POST, $_FILES);
                }
             ?>
                <div class="card">
                  <form class="needs-validation" action="" method="POST" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Add Post</h4>
                    </div>
                    <div class="card-body">
                   
                      <div class="form-group">
                        <label>Post Title:</label>
                        <input type="text" class="form-control" name="post_title" required>
                        <div class="invalid-feedback">
                          Input  Post Title
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label>Post Content:</label>
                       <textarea class="form-control" name="post_body" placeholder="Input Post Content" required></textarea>
                        <div class="invalid-feedback">
                          Input  Post Content
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Post Category:</label>
                       <select class="form-control" name="post_category" required >
                            <option value="" >Select Post Category</option>
                            <?php
                            $query = "select * from category_tbl";
                            $run_query= mysqli_query($conn, $query);
                            while ($result= mysqli_fetch_assoc($run_query)) { ?>
                            <option value="<?= $result['cat_id']; ?>"><?= $result['cat_name'] ?></option>
                            <?php }
                            ?>
                       </select>
                        <div class="invalid-feedback">
                          Input  Post Content
                        </div>
                      </div>
                     <div class="form-group">
                        <label>Post Image:</label>
                       <input type="file" class="form-control"  name="post_img" required />
                        <div class="invalid-feedback">
                          Input  Post Image
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Read Time:</label>
                       <select class="form-control" name="read_time" required >
                            <option value="" >Select Read Time</option>
                            <option value="2" >2 mins</option>
                            <option value="3" >3 mins</option>
                            <option value="4" >4 mins</option>
                            <option value="5" >5 mins</option>
                         
                       </select>
                        <div class="invalid-feedback">
                          select read time
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Post Tag</label>
                       <input type="text" class="form-control"  name="post_tags" required/>
                        <div class="invalid-feedback">
                          Input  Post tags
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_post" value="Add Post"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>