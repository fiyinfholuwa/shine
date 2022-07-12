<?php include "helper/header.php"; ?>
  
  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-8" data-bg-img="images/bg1.jpg">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title text-white"><?php
            if (isset($_GET['id'])) {
                $query = "select * from category_tbl where cat_id = '$_GET[id]' ";
             $run_query = mysqli_query($conn, $query);
             $fetch = mysqli_fetch_assoc($run_query);
             $cat_id = $fetch['cat_id'];

              
            } else {
                echo "<script>window.open('blog','_self')</script>";
            } ?>
             
              Category: <?php echo $fetch['cat_name']; ?></h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index">Home</a></li>
               
                <li class="active text-white">Post Category:  <?php echo $fetch['cat_name']; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Blog -->
   
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row blog-posts">
          <div class="col-md-12">
            <!-- Blog Masonry -->
            <div id="grid" class="gallery-isotope grid-2 masonry gutter-30 clearfix">
            <?php
              if (isset($_GET['page'])) {
              $page_num = $_GET['page'];
                  }else{
                      $page_num = 1;
                  }
              $i = 0; 
                  $i++;
            $no_of_record_per_page = 6;
            $offset = ($page_num - 1 ) * $no_of_record_per_page;
                    $blog = new Posts();
                    $cat_id = $cat_id;
                    $getPost = $blog->getAllPostCategoryHome($cat_id, $offset, $no_of_record_per_page);
                    if ($getPost) {
                        while ($result = $getPost->fetch_assoc()) { ?>
              <!-- Blog Item Start -->
              <div class="gallery-item">
                <article class="post clearfix mb-30 bg-lighter">
                  <div class="entry-header">
                    <div style='height:400px; overflow: hidden;' class="post-thumb thumb"> 
                      <img src="adminpanel/<?= $result['post_image']; ?>" alt="" class="img-responsive img-fullwidth"> 
                    </div>
                  </div>
                  <div class="entry-content border-1px p-20 pr-10">
                    <div class="entry-meta media mt-0 no-bg no-border">
                      <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                        <ul>
                          <li class="font-16 text-white font-weight-600">Views ( <?= $result['post_count']; ?> )</li>
                        
                        </ul>
                      </div>
                      <div class="media-body pl-15">
                        <div class="event-content pull-left flip">
                          <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="content?id=<?= $result['post_id']; ?>&<?= UrlConverter($result['post_title']); ?>"><?= $result['post_title']; ?></a></h4>
                                                
                                             
                        </div>
                      </div>
                    </div>
                    <p class="mt-10"><?= substr($result['post_content'], 0,100) . '...'; ?></p>
                    <a href="content?id=<?= $result['post_id']; ?>&<?= UrlConverter($result['post_title']); ?>" class="btn-read-more">Read more</a>
                    <div class="clearfix"></div>
                  </div>
                </article>
              </div>
              <!-- Blog Item End -->
             
              <?php } }else{ ?>
              <div class="text-center" style="color: red; height: 300px !important;">No Post yet for this category.</div>
             <?php } ?>

            </div>
            <!-- Blog Masonry -->
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <nav>
            <nav>
              <?php 
                $query = "select * from post_tbl where post_category = '$cat_id'";
                $run_query = mysqli_query($conn, $query);
                $total_pager = mysqli_num_rows($run_query);
                if ($total_pager> $no_of_record_per_page) { ?>
                  <ul class="pagination">

            
                <li><a class="page-numbers  "  href="<?php if($page_num <=1) { echo '#!';}else{ echo '?page='.($page_num - 1);} ?> " aria-label="Previous"><span aria-hidden="true">&#xAB;</a></li>
                
                            <?php

                            
                            
                            $pagination = new Pagination();
                            $total_pages = $pagination->Paginate('post_tbl', $no_of_record_per_page);
                            
                                for ($i=1; $i <=$total_pages; $i++) { 
                                if ($page_num== $i) {
                                    echo '<li><a class="page-numbers active page-link" href="?page='. $i .'">'. $i . '</a></li>';
                                }
                                
                                }
                            ?>
                            <li><a class="page-numbers"  href="<?php if($page_num>=$total_pages) { echo '#!';}else{ echo '?page='.($page_num+ 1);} ?>" aria-label="Next"><span aria-hidden="true">&#xBB;</span></a></li>
                        </ul>   
                </nav>
                
            </center>

          <?php } ?>
            </nav>
            </nav>
          </div>
        </div>
      </div>
    </section> 
  </div>  
  <!-- end main-content -->

<?php include "helper/footer.php"; ?>
  