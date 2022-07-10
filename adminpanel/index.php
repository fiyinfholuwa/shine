<?php include "helper/header.php"; ?>
      <?php include "helper/sidebar.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All posts</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from post_tbl";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href ='all-posts'>view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All Audios</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from audio_tbl";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href = 'all-audios' >view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/audio.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All PDFs</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from pdf_tbl";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href='all-pdf'>view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/pdf.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All team</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from team_tbl";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href='all-team'>view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/team.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All Testimonial</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from testimony_tbl";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href='all-testimonial'>view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/test.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All Awards</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from award_tbl";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href='all-awards'>view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/award.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All Members</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from membership";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href='membership'>view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/member.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All Messages</h5>
                          <h2 class="mb-3 font-18"><?php 
                          $query = "select * from main_contact";
                          $run_query = mysqli_query($conn, $query);
                          $count = mysqli_num_rows($run_query);
                          if ($count == 0 ) {
                            echo "0";
                          } else {
                            echo $count;
                          }
                          
                          ?></h2>
                          <p class="mb-0"><a href='contact-main' >view all</a></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/message.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
              
         
          </div> 
        </div>
      </div>

<?php include "helper/footer.php" ?>