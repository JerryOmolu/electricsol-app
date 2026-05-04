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
                  <p class="card-title">ALL USERS</p><hr>
                <a href="add_user"><button class="btn btn-outline-success"><i class="fa fa-plus" aria-hidden="true"></i>
 Add New User</button></a>
                  <div class="row">   
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-hover table-bordered table-striped">
                      <thead class="table-info">
                        <tr>
                          <th>Full Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Gender</th>
                          <th>Role</th>
                          <th>Added On</th>
                          <th>Added By</th>
                          <th>Verification Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                          
                <?php
                $perpage = 20;
                    if(isset($_GET['page'])){
                        $page = escape($_GET['page']);
                    }else{
                        $page = "";
                    }
                    if($page == "" || $page == 1){
                        $page_1 = 0;
                    }else{
                        $page_1 = ($page * $perpage)-$perpage;
                    }
                
                    $query1 = "SELECT * FROM user ORDER BY added_on DESC";
                    $view_users1 = mysqli_query($connection, $query1);
                    $total = mysqli_num_rows($view_users1);
                    $total = ceil($total/$perpage);
                    $Previous = (int)$page - 1;
                    $Next = (int)$page + 1;  
                          
                $query = "SELECT * FROM user ORDER BY added_on DESC LIMIT $page_1, $perpage";
                $view_users = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_users)){
                    $user_id = escape($row['user_id']);
                    $fullname = escape($row['fullname']);
                    $username = escape($row['username']);
                    $email = escape($row['email']);
                    $phone = escape($row['phone']);
                    $gender = escape($row['gender']);
                    $role = escape($row['role']);
                    $added_on = escape($row['added_on']);
                    $added_by = escape($row['added_by']);
                    $verify_status = escape($row['verify_status']);
                    echo "
                    <tr>
                <td>{$fullname}</td>
                <td>{$username}</td>
                <td>{$email}</td>
                <td>{$phone}</td>
                <td>{$gender}</td>
                <td>{$role}</td>
                <td>{$added_on}</td>
                <td>{$added_by}</td>";
            
                          if($verify_status == '0'){
                              echo "<td><button class='btn btn-danger'>Unverified</button></td>";
                          }else{
                              echo "<td><button class='btn btn-success'>Verified</button></td>";
                          }
                          
                 echo"<td><a href='edit_user?source=edit_user&edit_user={$user_id}'><button type='button' class='btn btn-warning btn-rounded btn-icon'>
                <i class='ti-pencil-alt'></i>
                </button></a> &nbsp;<a href='delete_user?id=$user_id'><button type='button' class='btn btn-danger btn-rounded btn-icon'>
                <i class='ti-trash'></i>
                </button></a></td>
              </tr>
                    ";
                }

                ?>  
                            
                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
                  </div>
                    
        <!--    Pagination-->
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="Page navigation">
               <ul class="pagination">
                  <li>
                      <a href="view_users?page=<?= $Previous; ?>" aria-label="Previous">
                       <span aria-hidden="true"><button class="btn btn-md btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Previous</button></span>   
                      </a>
                  </li>
                <?php 
                for($i=1; $i<=$total; $i++){
                if($i == $page){
                echo "<li><a href='view_users?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>";
                }else{
                echo "<li><a href='view_users?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>"; 
                }
                }
                ?>
                   <li>
                       <a href="view_users?page=<?= $Next; ?>" aria-label="Next">
                        <span aria-hidden="true"><button class="btn btn-md btn-primary">Next&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></button> </span>
                       </a>
                   </li>
               </ul>
                
            </nav>
        </div>
    </div>                
    <style>
.pagination li .active-link{
    background: #000 !important
}

</style>                 
                    
                  </div>
                </div>
              </div>
            </div>
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
