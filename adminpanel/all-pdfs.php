<?php include "helper/header.php"; ?>
      <?php include "helper/sidebar.php"; ?>
      <!-- Main Content -->
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All PDFs</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            
                            <th>S/N</th>
                            <th>Pdf Title</th>
                            <th>PDF Content</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                         $pdf = new Download();
                        if (isset($_GET['delPdf'])) {
                            $id = $_GET['delPdf'];
                            $delMessage = $pdf->delPdfById($id);
                        }
                        
                          $i=0;
                          $getPdf = $pdf->getPdf('pdf_tbl', 'pdf_id');
                          if ($getPdf) {
                              while ($result = $getPdf->fetch_assoc()) {
                               $i++; ?>
                      
                       
                          <tr>
                            <td>
                              <?= $i; ?>
                            </td>
                            <td><?= $result['pdf_title']; ?></td>
                            <td><a href="<?= $result['uploaded_pdf']; ?>" target="_blank" class="btn btn-info">check file</a></td>
                            <td>
                            
                              <a style="padding: 6px; font-size:25px;" href="?delPdf=<?= $result['pdf_id'];?>"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                            
                          </tr>
                          <?php } } ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       

<?php include "helper/footer.php" ?>