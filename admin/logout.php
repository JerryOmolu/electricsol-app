<?php session_start(); ?>
<?php 

$_SESSION['user_id'] = null;
$_SESSION['fullname'] = null;
$_SESSION['username'] = null;
$_SESSION['email'] = null;
$_SESSION['phone'] = null;
$_SESSION['gender'] = null;
$_SESSION['role'] = null;
$_SESSION['added_on'] = null;
$_SESSION['verify_status'] = null;
        

        header("Location:index");
?>