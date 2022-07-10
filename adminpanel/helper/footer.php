<footer class="main-footer">
        <div class="footer-left">
          
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/toastr.min.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script>
    <?php if(isset($_SESSION['success'])): ?>
      toastr.options = {
  "closeButton": true,

  "progressBar": true,
  
  "preventDuplicates": false,
  "showDuration": "1000",
  "hideDuration": "1000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
      toastr.success("<?= Flash('success'); ?>");
    <?php endif ?>
    <?php if(isset($_SESSION['error']) ): ?>
      toastr.error("<?= Flash('error'); ?>");

    <?php endif ?>
  </script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>