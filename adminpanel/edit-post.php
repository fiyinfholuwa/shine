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
                if (!isset($_GET['edit']) || $_GET['edit'] == NULL) {
                    echo "<script>window.location = 'all-posts'</script>";
                }else{
                    $id = $_GET['edit'];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_post'])) {


                    $edit_post = $post->UpdatePost($_POST, $_FILES, $id);
                }

                 ?>
                <div class="card">
                <?php
                $post_id = $id;
               
                 $getPost= "select * from post_tbl where post_id ='$post_id' ";
                 $run_query = mysqli_query($conn, $getPost);
                 $result = mysqli_fetch_array($run_query); ?>
                  <form class="needs-validation" action="" method="POST" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Update Post</h4>
                    </div>
                    <div class="card-body">
                   
                      <div class="form-group">
                        <label>Post Title:</label>
                        <input type="text" class="form-control" value="<?= $result['post_title']; ?>" name="post_title" required>
                        <div class="invalid-feedback">
                          Input  Post Title
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Post Tags:</label>
                        <input type="text" class="form-control" value="<?= $result['post_tags']; ?>" name="post_tags" required>
                        <div class="invalid-feedback">
                          Input  Post Tags
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Post Image:</label>
                       <input type="file" class="form-control"  name="post_img" />
                       <div>
                          
                       <img height="40" width="50" src="<?= $result['post_image']; ?>"  alt="hello"/>
                       </div>
                        <div class="invalid-feedback">
                          Input  Post Image
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label>Post Content:</label>
                       
                       <textarea class="form-control" name="post_body" placeholder="Input Post Content" required><?= $result['post_content']; ?></textarea>
                        <div class="invalid-feedback">
                          Input  Post Content
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Post Category:</label>
                       <select class="form-control" name="post_category" required >
                            <option disabled >Select Post Category</option>
                            <?php
                            $select_category = $result['post_category'];
                            $query = "select * from category_tbl where cat_id = '$selected_category' ";
                            $run_query= mysqli_query($conn, $query);
                            while ($result= mysqli_fetch_assoc($run_query)) { ?>
                            <option selected value="<?= $result['cat_id']; ?>"><?= $result['cat_name'] ?></option>
                            <?php }
                            ?>
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
                        <label>Read Time:</label>
                       <select class="form-control" name="read_time" required >
                       <?php 
                       $read_time = $result['read_time'];
                        $sql = "SELECT * FROM post_tbl WHERE read_time = '$read_time' ";
                        $execution = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        $selected = "";
                        while($result = mysqli_fetch_assoc($execution)){ ?>
                        <option selected="" value="<?= $result['read_time']; ?>" ><?= $result['read_time']; ?> Minutes</option>

                        <?php }?>
                           
                            <option value="2" >2 mins</option>
                            <option value="3" >3 mins</option>
                            <option value="4" >4 mins</option>
                            <option value="5" >5 mins</option>
                         
                       </select>
                        <div class="invalid-feedback">
                          select read time
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="update_post" value="Update Post"/>
                    </div>
                  </form>
               
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>