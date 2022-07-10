<!-- Footer -->
<footer id="footer" class="footer bg-black-222" data-bg-img="images/footer-bg.png">
<div class="container pt-10 pb-10">
      <div class="row">
       
      <p style="margin-top: 30px; text-align:center;">Copyright &copy; - Shining star family fellowship</p>

				
					<p style="font-size: 8px; text-align: center; color: grey;">Developed by: DaraTech, 08097238712</p>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper --> 

<!-- Footer Scripts --> 
<!-- JS | Custom script for all pages --> 
<script src="js/custom.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
      (Load Extensions only on Local File Systems ! 
       The following part can be removed on Server for On Demand Loading) --> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script> 
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
<script src="../adminpanel/assets/js/toastr.min.js"></script>
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

<!-- index-sp-layout309:19-->
</html>