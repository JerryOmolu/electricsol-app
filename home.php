<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>
<!--Header Area-->
<?php include "includes/header_area.php"; ?> 

  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>  

  <div class="page-content-wrapper">

    <!-- Tiny Slider One Wrapper -->
<?php include "includes/home_hero.php"; ?> 

    <div class="pt-3"></div>
<!--Quick Links-->
<?php include "includes/quick_link.php"; ?>
     
<!--Energy Calculator-->

<?php include "includes/calculator-guide.php"; ?>


       <div class="pb-3"></div>
<!--Contact Disco-->
      <?php include "includes/artisan.php"; ?>
      <br>
      
<!--Contact Disco-->
<?php include "includes/disco.php"; ?><br>
    
<!--Shop-->
 

      
<?php include "includes/shop-cta.php"; ?><br>

    <!--Customer Review-->
<?php include "includes/review.php"; ?>

    <div class="pb-3"></div>
  </div>


<?php include "includes/home_footer_nav.php"; ?>
 