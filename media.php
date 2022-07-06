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
          <div style="padding: 10px; box-shadow: 2px 3px 2px navy;">
            <h3 style="color: #0000fb;" >Power of Worship</h3>
                <audio style="width:90%;"  controls>
                    <source src="audio.mp3" type="audio/mp3">
                </audio>
                <div class="mt-2">
                    <a href="" class="btn btn-danger btn-lg">Download</a>
                </div>
            </div>
            <div style="padding-top:30px;">
            <nav class="">
              <ul class="pagination xs-pull-center m-0">
                <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">...</a></li>
                <li> <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>
              </ul>
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
