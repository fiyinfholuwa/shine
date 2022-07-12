<?php include "helper/header.php"; ?>
  
  <!-- Start main-content -->
  <div class="main-content bg-lighter">
    

    <!-- Section: About -->
    <section id="about">
      <div class="container mt-50 pb-70 pt-0">
        <div class="section-content">
          <div class="row mt-10">
            <div class="col-sm-12 col-md-6 mb-sm-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <h3 class="text-uppercase mt-15 text-center">About <span class="text-theme-color-2">Us</span></h3>
              <p class="lead">Kingdom Stars Academy was dedicated to the glory of God in Ekiti, July 24th, 2021 during the $th year anniversary all night service.</p>
              <p class="mb-15">Kingdom Academy School is the secondary school arm of our mission school while the fruitful kids model is the primary school. The vision is to birth world restorers scholars who will add beautiful color to the earth in all areas of life.</p>
              <p class="mb-10">The vision shall be planted across Nigeria with a great campus and across Nation capital of all African countries andsome other countries of other continents wherwe we shall have our ministry being established, to th glory of God and the advancement of the kingdom of God.</p>
              <p class="mb-10">The school runs both Day and Boarding structure.</p>
              
            </div>
            <div class="col-sm-12 col-md-6 mt-10 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
              <div style="height: 300px;">                
                
                  <img alt="" style="height:300px;" src="images/certificate.jpg" class="img-responsive  mt-10 ml-30 ml-xs-0 ml-sm-0">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Section: teachers -->
    <section class="bg-lightest">
      <div class="container pt-50 pb-80">
        <div class="section-content">
          <div class="row">
            <div class="col-md-6 wow mt-20 fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
              <h3 class="text-uppercase title line-bottom mt-0 mb-30">What people <span class="text-theme-color-2">say about us</span></h3>
              <div class="owl-carousel-2col">
              <?php
              
              $test = new Testimony();
              $gettest = $test->getTestimonyHome();
              if ($gettest) {
                  while ($result = $gettest->fetch_assoc()) { ?>
                <div class="item">
                  <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                    <div class="team-thumb">
                      <img class="img-fullwidth" alt="" src="../adminpanel/<?= $result['test_image']; ?>">
                      <div class="team-overlay"></div>
                    </div>
                  <div class="team-details bg-silver-light pt-10 pb-10">
                    <h4 class="text-uppercase font-weight-600 m-5"><?= $result['full_name']; ?></h4>
                      <h6 class="text-theme-colored font-15 font-weight-400 mt-0"><?= $result['content']; ?></h6>
                      <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                        <p><?= $result['role']; ?></p>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php }}else{?>
      <div class="text-center" style="color: red;height: 300px;">No Testimonial Yet.</div>
    <?php } ?>
              
              </div>
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
              <h3 class="text-uppercase ml-15 title line-bottom">Our <span class="text-theme-color-2 font-weight-700">Awards</span></h3>
              <div class="bxslider bx-nav-top p-0 m-0">
              <?php
              
              $award = new Award();
              $getaward = $award->getAward('award_tbl', 'award_id');
              if ($getaward) {
                  while ($result = $getaward->fetch_assoc()) { ?>  
                <div class="col-xs-12 pr-0 col-sm-6 col-md-6 mb-20">
                  <div class="pricing table-horizontal maxwidth400">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="thumb">
                        <img class="img-fullwidth mb-sm-0" src="../adminpanel/<?= $result['award_image']; ?>" alt="">
                        </div>
                      </div>
                      <div class="col-md-6 p-10 pl-sm-50">
                        <h4 class="mt-0 mb-5 mt-10"><?= $result['award_title']; ?></h4>
                        <ul class="list-inline font-16 mb-5 text-white">
                          <li class="pr-0"><i class="fa fa-calendar mr-5"></i><?= $result['award_date']; ?></li>
                          <li class="pl-5"><i class="fa fa-map-marker mr-5"></i><?= $result['award_org']; ?></li>
                        </ul>
                        <!-- <p class="mb-0 font-13 text-white mr-5 pr-10">Lorem ipsum dolor sit amet, conse ctetur adipisicing elit. Quas eveniet.</p -->
                        <!-- <a class="font-16  text-white mt-20" href="#">Read More →</a> -->
                      </div>
                    </div>
                  </div>
                </div>
              <?php } }else {?>
                <div class="text-center" style="color: red;height: 300px;">No Award yet.</div>
              <?php } ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Reservation Form -->
    

    <!-- Divider: Clients -->
    

  </div>
  <!-- end main-content -->
  
  <?php include "helper/footer.php"; ?>