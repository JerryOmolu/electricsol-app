<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Affan - PWA Mobile HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta name="theme-color" content="#0134d4">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <!-- Title -->
  <title>Electricsol-Mobile App</title>

  <!-- Favicon -->
    <link rel="icon" href="favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
<!--Font Awesome-->
    <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">
    
<!--RATING SECTION-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Web App Manifest -->
  <link rel="manifest" href="manifest.json">
    
<!--Summernote-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Dark mode switching -->
  <div class="dark-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="dark-mode-text text-center">
        <i class="bi bi-moon"></i>
        <p class="mb-0">Switching to dark mode</p>
      </div>
      <div class="light-mode-text text-center">
        <i class="bi bi-brightness-high"></i>
        <p class="mb-0">Switching to light mode</p>
      </div>
    </div>
  </div>

  <!-- RTL mode switching -->
<!--
  <div class="rtl-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="rtl-mode-text text-center">
        <i class="bi bi-text-right"></i>
        <p class="mb-0">Switching to RTL mode</p>
      </div>
      <div class="ltr-mode-text text-center">
        <i class="bi bi-text-left"></i>
        <p class="mb-0">Switching to default mode</p>
      </div>
    </div>
  </div>
-->

  <!-- # Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

  <!-- Header Area -->
  <div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
        <!-- Back Button -->
        <div class="back-button">
          <a href="home.php">
            <i class="bi bi-arrow-left-short"></i>
          </a>
        </div>

        <!-- Page Title -->
        <div class="page-heading">
          <h6 class="mb-0"> Page Not Found</h6>
        </div>

        <!-- Navbar Toggler -->
        <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
          aria-controls="affanOffcanvas">
          <span class="d-block"></span>
          <span class="d-block"></span>
          <span class="d-block"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Page Content Wrapper -->
  <div class="page-content-wrapper py-3">
    <div class="custom-container">
      <div class="card">
        <div class="card-body px-5 text-center">
          <img class="mb-4" src="img/electrisol-img/404.png" alt=""><br><br>
          <h4>OOPS... <br> Page not found!</h4><br><br>
<!--          <p class="mb-4">We couldn't find any results for your search. Try again.</p>-->
<a class="btn btn-creative btn-dark" href="home.php"><i class="fa fa-home" aria-hidden="true"></i>
 Go to Home</a><br><br>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Nav -->
 <?php include "includes/home_footer_nav.php"; ?>