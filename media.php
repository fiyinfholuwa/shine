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
              <h2 class="title text-white">Media</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index">Home</a></li>
             
                <li class="active text-white">Download Audio</li>
              </ol>

            </div>
            <div class="col-md-6 col-lg-6 col-6 mt-3">
            <div class="mt-2 text-center">
                    <a href="" class="btn btn-danger btn-sm">Connect to Mixlr Radio</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-6 mt-3">
            <div class="mt-5 text-center">
                    <a href="" class="btn btn-primary btn-sm">Connect to Youtube Live.</a>
                </div>
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
                    $audio = new Audio();
                    $getAudio = $audio->getAllAudioHome('audio_tbl', $offset, $no_of_record_per_page, 'audio_id');
                    if ($getAudio) {
                        while ($result = $getAudio->fetch_assoc()) { ?>  
          <div style="padding: 10px; box-shadow: 2px 3px 2px navy; margin-top: 20px;">
            <h3 style="color: #0000fb;" ><?= $result['audio_title']; ?></h3>
                <audio style="width:90%;"  controls>
                    <source src="adminpanel/<?= $result['uploaded_audio']; ?>" type="audio/mp3">
                </audio>
                <div class="mt-2">
                    <a href="adminpanel/<?= $result['uploaded_audio']; ?>" class="btn btn-danger btn-lg" download>Download</a>
                </div>
            </div>
            <?php }}else{?>
      <div class="text-center" style="color: red;height: 400px;">No uploaded audios yet.</div>
    <?php } ?>
    <div style="padding-top:30px;">
            <nav class="">
            <nav>
              <?php 
                $query = "select * from audio_tbl";
                $run_query = mysqli_query($conn, $query);
                $total_pager = mysqli_num_rows($run_query);
                if ($total_pager> $no_of_record_per_page) { ?>
                  <ul class="pagination">

            
                <li><a class="page-numbers  "  href="<?php if($page_num <=1) { echo '#!';}else{ echo '?page='.($page_num - 1);} ?> " aria-label="Previous"><span aria-hidden="true">&#xAB;</a></li>
                
                            <?php

                            
                            
                            $pagination = new Pagination();
                            $total_pages = $pagination->Paginate('audio_tbl', $no_of_record_per_page);
                            
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
