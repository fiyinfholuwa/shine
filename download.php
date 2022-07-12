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
              <h2 class="title text-white">Download PDFs</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index">Home</a></li>
             
                <li class="active text-white">download</li>
              </ol>
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
                    $pdf = new Download();
                    $getPdf = $pdf->getAllPdfHome('pdf_tbl', $offset, $no_of_record_per_page, 'pdf_id');
                    if ($getPdf) {
                        while ($result = $getPdf->fetch_assoc()) { ?>
          <div style="padding: 10px; box-shadow: 2px 3px 2px navy; margin-top:20px;">
            <h3 style="color: #0000fb;" ><?= $result['pdf_title']; ?></h3>
               
                <div class="mt-2">
                    <a href="adminpanel/<?= $result['uploaded_pdf']; ?>" target="_blank" class="btn btn-danger btn-lg">Download</a>
                </div>
            </div>
    <?php }}else{?>
      <div class="text-center" style="color: red;height: 400px;">No uploaded Pdf resource yet.</div>
    <?php } ?>

            <div style="padding-top:30px;">
            <nav class="">
            <nav>
              <?php 
                $query = "select * from pdf_tbl";
                $run_query = mysqli_query($conn, $query);
                $total_pager = mysqli_num_rows($run_query);
                if ($total_pager> $no_of_record_per_page) { ?>
                  <ul class="pagination">

            
                <li><a class="page-numbers  "  href="<?php if($page_num <=1) { echo '#!';}else{ echo '?page='.($page_num - 1);} ?> " aria-label="Previous"><span aria-hidden="true">&#xAB;</a></li>
                
                            <?php

                            
                            
                            $pagination = new Pagination();
                            $total_pages = $pagination->Paginate('pdf_tbl', $no_of_record_per_page);
                            
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
