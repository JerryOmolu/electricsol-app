<?php include "includes/admin_header.php"; ?>
<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home.php');
}

?>

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
                  <p class="card-title">EDIT USER</p><hr>
                  <div class="row">
            <div class="col-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
<!--Edit User Code-->
<?php 
if(isset($_GET['edit_user'])){
    $the_user_id = escape($_GET['edit_user']);
    $query = "SELECT * FROM user WHERE user_id = $the_user_id ";
        $select_users = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_users)){
        $user_id = escape($row['user_id']);
		$fullname = escape($row['fullname']);
		$username = escape($row['username']);
		$email = escape($row['email']);
		$phone = escape($row['phone']);
		$gender = escape($row['gender']);
		$password = escape($row['password']);
		$role = escape($row['role']);
		$added_on = escape($row['added_on']);
		$added_by = escape($row['added_by']);
}


if(isset($_POST['edit_user'])){
    $name = escape($_POST['name']);
    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $phone = escape($_POST['phone']);
    $password = escape($_POST['password']);
    $role = escape($_POST['role']);
    
    $password= password_hash ($password, PASSWORD_BCRYPT, array('cost' => 10));

    
    $query = "UPDATE user SET email = '{$email}', phone = '{$phone}', role = '{$role}', password = '{$password}' WHERE user_id = {$the_user_id} ";
    $update_user = mysqli_query($connection,$query);
    if(!$update_user){
   die('QUERY FAILED' . mysqli_error($connection));
   }
    echo "<div class='alert alert-success'>User Edited Successfully:" . " " . "&nbsp;&nbsp;&nbsp;<a href='view_users.php'><button class='btn btn-primary'>View Users</button></a></div>";
}

}

?>
<!--End of Edit User Code-->
                    
                    
                    
                    
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Full Name" name="name" maxlength="50" autocomplete="off" value="<?php echo $fullname; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUserName1">Username</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Prefered Username" name="username" maxlength="50" autocomplete="off" value="<?php echo $username; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email Address" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPhone">Phone Number</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Phone Number" name="phone" maxlength="11" value="<?php echo $phone; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">User Role</label>
                      <select class="form-control" id="exampleSelectRole" name="role" required>
                          <option value='<?php echo $role; ?>'><?php echo $role; ?></option>
                          <option value="Admin">Admin</option>
                          <option value="Manager">Manager</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary col-6 mr-2" name="edit_user"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update User</button>
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
