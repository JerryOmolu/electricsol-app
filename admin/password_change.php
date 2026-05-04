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
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome! <?php echo $_SESSION['fullname'] ?></h3>
                </div>
              </div>
            </div>
          </div>
<!--    Main Content Wrapper-->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Change Password</p>
                  <div class="row">
            <div class="col-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
<!--Change Password Code-->
<?php 
 if(isset($_SESSION['fullname'])){
	$fullname = escape($_SESSION['fullname']);
     } 
	if(isset($_SESSION['phone'])){
	$phone = escape($_SESSION['phone']);
	} 
                        

if(isset($_POST['change_password'])){

    $password =escape($_POST['password']);
    $new_password =escape($_POST['new_password']);
	$confirm_password =escape($_POST['confirm_password']);
	
		
 if(!empty ($password) && !empty ($new_password) &&!empty ($confirm_password)){
	
$query = "SELECT * FROM user WHERE phone = '{$phone}'";
$select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }
while($row= mysqli_fetch_array($select_user_query)){
    $db_fullname = escape($row['fullname']);
    $db_username = escape($row['username']);
    $db_email = escape($row['email']);
    $db_phone = escape($row['phone']);
    $db_gender = escape($row['gender']);
    $db_password = escape($row['password']);
    $db_role = escape($row['role']);
    $db_added_on = escape($row['added_on']);
    $db_verify_status = escape($row['verify_status']);
}
    
    if(password_verify($password, $db_password)){
        $_SESSION['fullname'] = $db_fullname;
        $_SESSION['username'] = $db_username;
        $_SESSION['email'] = $db_email;
        $_SESSION['phone'] = $db_phone;
        $_SESSION['gender'] = $db_gender;
        $_SESSION['password'] = $db_password;
        $_SESSION['role'] = $db_role;
        $_SESSION['added_on'] = $db_added_on;
        $_SESSION['verify_status'] = $db_verify_status;
        
		if($new_password == $confirm_password){
			
		$hashedPassword= password_hash ($new_password, PASSWORD_BCRYPT, array('cost' => 10));
				
		$update_password = "UPDATE user SET password='$hashedPassword' WHERE phone = '{$phone}'";
		$update_password_run = mysqli_query($connection, $update_password);
			
			echo " <div class='alert alert-success'>Password Changed Successfully! </div>";
		}else{
			echo " <div class='alert alert-danger'>New Password and Confirm Password does not match! </div>";
		}
		
    }else {
		echo " <div class='alert alert-danger'>Current Password is Incorrect</div>";
	}
 }
}
	 ?> 
<!--End of Change Password Code--> 
                    
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputPassword4">Current Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Current Password" name="password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">New Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="New Password" name="new_password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Confirm New Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Confirm New Password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="change_password">Change Password</button>
                  </form>
                </div>
              </div>
            </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
