<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  

<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
 <?php include "includes/welcome.php"; ?>   

<!--    Main Content Wrapper-->
<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">MY PROFILE</p><hr>
    
          <div class="row">
                   <?php 
                     
                    if(isset($_SESSION['fullname'])){
                    $fullname = escape($_SESSION['fullname']);
                    }
                $query = "SELECT * FROM user WHERE fullname   = '$fullname'";
                $view_user = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_user)){
                    $user_id = escape($row['user_id']);
                    $fullname = escape($row['fullname']);
                    $username = escape($row['username']);
                    $email = escape($row['email']);
                    $phone = escape($row['phone']);
                    $gender = escape($row['gender']);
                    $role = escape($row['role']);
                    $added_on = escape($row['added_on']);
                    $added_by = escape($row['added_by']);
                    $verify_token = escape($row['verify_token']);
                    $verify_status = escape($row['verify_status']);
                    ?>
                  <div class="media">
                    <table class='table table-hover table-bordered table-striped table-responsive'>
                    <tbody>   
                   <tr>
                    <td><b>Name:</b></td>
                    <td><?php echo $fullname ?></td>
                    </tr>
                    <tr>
                    <td><b>Username:</b></td>
                    <td><?php echo $username ?></td>
                    </tr>
                    <tr>
                    <td><b>Email Address:</b></td>
                    <td><?php echo $email ?></td>
                    </tr>
                    <tr>
                    <td><b>Phone Number:</b></td>
                    <td><?php echo $phone ?></td>
                    </tr>
                    <tr>
                    <td><b>Gender:</b></td>
                    <td><?php echo $gender ?></td>
                    </tr>
                    <tr>
                    <td><b>Role:</b></td>
                    <td><?php echo $role ?></td>
                    </tr>
                    <tr>
                    <td><b>Added On:</b></td>
                    <td><?php echo $added_on ?></td>
                    </tr>
                    </tbody> 
                    </table>
                    </div>
                      
        <?php } ?>
              </div>
            </div>
    
    </div>
    
    
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
