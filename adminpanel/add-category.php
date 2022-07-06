<?php include "helper/header.php"; ?>
      <?php include "helper/sidebar.php"; ?>
      <!-- Main Content -->
    <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
              
                <div class="card">
                  <form class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Add Category</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" class="form-control" required="">
                        <div class="invalid-feedback">
                          What's your name?
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" required="">
                        <div class="invalid-feedback">
                          Oh no! Email is invalid.
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="email" class="form-control">
                        <div class="valid-feedback">
                          Good job!
                        </div>
                      </div>
                      <div class="form-group mb-0">
                        <label>Message</label>
                        <textarea class="form-control" required=""></textarea>
                        <div class="invalid-feedback">
                          What do you wanna say?
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>