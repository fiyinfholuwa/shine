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
                $pdf = new Download();
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_pdf'])) {
                  
                    $insertpdf = $pdf->AddPdf($_POST, $_FILES);
                }
             ?>
                <div class="card">
                  <form class="needs-validation" action="" method="post" novalidate="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Add PDF</h4>
                    </div>
                    <div class="card-body">
                    
                      <div class="form-group">
                        <label>PDF Title:</label>
                        <input type="text" class="form-control" name="pdf_title" required="">
                        <div class="invalid-feedback">
                          Input  PDF title
                        </div>
                      </div>

                      <div class="form-group">
                        <label>PDF File:</label>
                        <input type="file" class="form-control" name="pdf_file" required="">
                        <div class="invalid-feedback">
                          Add PDF file
                        </div>
                      </div>
                     
                    </div>
                    <div class="card-footer text-left">
                     <input type="submit" class="btn-primary btn-lg " name="new_pdf" value="Add PDF"/>
                    </div>
                  </form>
                </div>
              </div>
              
             
            </div>
          </div>
        </section>
       

<?php include "helper/footer.php" ?>