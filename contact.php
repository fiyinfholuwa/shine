<?php include "helper/header.php"; ?>
  
  <!-- Start main-content -->
  <div class="main-content bg-lighter">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg1.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white text-center">Contact Us</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="index">Home</a></li>

                <li class="active text-gray-silver">Contact Us</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Contact -->
    <section class="divider">
      <div class="container">
        <div class="row pt-30">
          <div class="col-md-4">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
                  <div class="media-body"> <strong>Address</strong>
                    <p>Plot 3, Oda road along superb, Akure, Ondo state, Nigeria, West Africa.</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-call text-theme-colored"></i></a>
                  <div class="media-body"> <strong>Phone Number</strong>
                    <p>+2347036736964</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-mail text-theme-colored"></i></a>
                  <div class="media-body"> <strong>E-MAIL</strong>
                    <p>Shiningstar@gmail.com</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-8">
            <h3 class="line-bottom mt-0 mb-20">Get In Touch</h3>
            <?php 
                $contact = new ContactUs();

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
                    
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $message = $_POST['message'];
                    

                    $insertContact = $contact->InsertContactUs($name, $email, $phone, $message);
                }

                ?>
            <!-- Contact Form -->
            <form id="contact_form" name="contact_form" class="" action="#" method="post">

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="name" class="form-control" type="text" placeholder="Enter Full Name" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="email" class="form-control  email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>
                
              <div class="row">
                
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="phone" class="form-control" type="text" placeholder="Enter Phone">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <textarea name="message" class="form-control " rows="5" placeholder="Enter Message"></textarea>
              </div>
              <div class="form-group">
              
                <button type="submit" name="send_msg" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" >Send message</button>
                
              </div>
            </form>

           
          </div>
        </div>
      </div>
    </section>
    
    
      </div>
    </section>
  </div>
  <!-- end main-content -->
  
<?php include "helper/footer.php"; ?>
  