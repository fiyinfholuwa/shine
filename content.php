<?php include "helper/header.php"; ?>
<?php
if(isset($_GET['id'])){
  $post_id = $_GET['id'];
  $post_title = "";
  $sql = "SELECT * FROM post_tbl WHERE post_id = '$post_id'";
  $execution = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if($title = mysqli_fetch_assoc($execution)){
    $post_title = $title['post_title'];
    $post_content = $title['post_content'];
    $post_image = $title['post_image'];
  }
}  

$cat_id = $title['post_category'];
$query = "select * from category_tbl where cat_id = '$cat_id' ";
$run_query = mysqli_query($conn, $query);
$fetch_cat = mysqli_fetch_assoc($run_query);
$sql2 = "UPDATE post_tbl SET post_count = post_count + 1 WHERE post_id = :id";
$stmt = $con->prepare($sql2);
$stmt->execute([
    ':id' => $post_id
]);

                            ?>
   <!-- Start main-content -->
   <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-8" data-bg-img="images/bg1.jpg">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title text-white"><?= $post_title; ?></h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index">Home</a></li>
             
                <li class="active text-white"><?= $post_title; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-md-8">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="entry-header">
                  <div class="post-thumb thumb"> <img src="adminpanel/<?=$title['post_image']  ?>" alt="" class="img-responsive img-fullwidth"> </div>
                </div>
                <div class="entry-content">
                  <div class="entry-meta media no-bg no-border mt-15 pb-20">
                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                      <ul>
                      <li class="font-16 text-white font-weight-600">Views ( <?= $title['post_count']; ?> )</li>
                      </ul>
                    </div>
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip">
                        <h3 class="entry-title text-white text-uppercase pt-0 mt-0"><a href="blog-single-right-sidebar.html"><?= $post_title; ?></a></h3>
                        
                      </div>
                    </div>
                  </div>
                  <p class="mb-15"><?= $title['post_content']; ?></p>
                  
                  <!-- <div class="mt-30 mb-0">
                    <h5 class="pull-left flip mt-10 mr-20 text-theme-colored">Share:</h5>
                    <ul class="styled-icons icon-circled m-0">
                      <li><a href="#" data-bg-color="#3A5795"><i class="fa fa-facebook text-white"></i></a></li>
                      <li><a href="#" data-bg-color="#55ACEE"><i class="fa fa-twitter text-white"></i></a></li>
                      <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus text-white"></i></a></li>
                    </ul>
                  </div> -->
                </div>
              </article>
              <div class="tagline p-0 pt-20 mt-5">
                <div class="row">
                  <div class="col-md-8">
                    <div class="tags">
                      <p class="mb-0"><i class="fa fa-tags text-theme-colored"></i> <span>Tags: <?= $fetch_cat['cat_name']; ?></span></p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="share text-right flip">
                      <!-- <p><i class="fa fa-share-alt text-theme-colored"></i> Share</p> -->
                    
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- <div class="comments-area">
                <h5 class="comments-title">Comments</h5>
                <ul class="comment-list">
                  <li>
                    <div class="media comment-author"> <a class="media-left" href="#"><img class="media-object img-thumbnail" src="images/blog/comment1.jpg" alt=""></a>
                      <div class="media-body">
                        <h5 class="media-heading comment-heading">John Doe says:</h5>
                        <div class="comment-date">23/06/2014</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ea commodo consequat...</p>
                         </div>
                    </div>
                  </li>
                 
                </ul>
              </div> -->
              <!-- <div class="comment-box">
                <div class="row">
                  <div class="col-sm-12">
                    <h5>Leave a Comment</h5>
                    <div class="row">
                      <form role="form" id="comment-form">
                        <div class="col-sm-6 pt-0 pb-0">
                          <div class="form-group">
                            <input type="text" class="form-control" required name="contact_name" id="contact_name" placeholder="Enter Name">
                          </div>
                          <div class="form-group">
                            <input type="text" required class="form-control" name="contact_email2" id="contact_email2" placeholder="Enter Email">
                          </div>
                          <div class="form-group">
                            <input type="text" placeholder="Enter Website" required class="form-control" name="subject">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <textarea class="form-control" required name="contact_message2" id="contact_message2"  placeholder="Enter Message" rows="7"></textarea>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-flat pull-right m-0" data-loading-text="Please wait...">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
          <div class="col-md-4">
            <?php include "helper/sidebar.php"; ?>
          </div>
        </div>
      </div>
    </section> 
  </div>  
  <!-- end main-content -->

  <?php include "helper/footer.php"; ?>
