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
              <h2 class="title text-white">Board of Trustee</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index">Home</a></li>
               
                <li class="active text-white">Team</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row multi-row-clearfix">
          <div class="blog-posts">
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
                       $team = new Team();
                       $getteam = $team->getAllTeamHome('team_tbl', $offset, $no_of_record_per_page, 'team_id');
                       if ($getteam) {
                           while ($result = $getteam->fetch_assoc()) { ?>
            
            <div class="col-md-4">
              <article class="post clearfix mb-30 bg-lighter">
                <div class="entry-header">
                  <div style='height:300px; overflow: hidden;' class="post-thumb thumb"> 
                    <img  src="adminpanel/<?= $result['team_image']; ?>" alt="" class="img-responsive img-fullwidth"> 
                  </div>
                </div>
                <div class="entry-content border-1px p-20 pr-10">
                  <div class="entry-meta media mt-0 no-bg no-border">
                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                     
                    </div>
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip">
                        <h4 class="entry-title text-black-400 text-uppercase m-0 mt-5"><?= $result['full_name']; ?></h4>
                                             
                      </div>
                    </div>
                  </div>
                  <p class="mt-10"><?=$result['role']; ?></p>
                 
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
            <?php } }else{ ?>
              <div class="text-center" style="color: red;height: 300px;">No information about the team yet.</div>
             <?php } ?>
            <div class="col-md-12">
              <nav>
              <?php 
                $query = "select * from team_tbl";
                $run_query = mysqli_query($conn, $query);
                $total_pager = mysqli_num_rows($run_query);
                if ($total_pager> $no_of_record_per_page) { ?>
                  <ul class="pagination">

            
                <li><a class="page-numbers  "  href="<?php if($page_num <=1) { echo '#!';}else{ echo '?page='.($page_num - 1);} ?> " aria-label="Previous"><span aria-hidden="true">&#xAB;</a></li>
                
                            <?php

                            
                            
                            $pagination = new Pagination();
                            $total_pages = $pagination->Paginate('team_tbl', $no_of_record_per_page);
                            
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
          
          </div>
        </div>
      </div>
    </section> 
  </div>  
  <!-- end main-content -->
  
  <?php include "helper/footer.php"; ?>
