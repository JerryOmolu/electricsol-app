<?php session_start(); ?>
<?php 

$_SESSION['fullname'] = null;
$_SESSION['email'] = null;
$_SESSION['phone'] = null;
$_SESSION['verify_token'] = null;
$_SESSION['verify_status'] = null;
$_SESSION['address'] = null;
$_SESSION['date'] = null;

        header("Location:login");
?>