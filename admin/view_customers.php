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
                  <p class="card-title">ALL CUSTOMERS</p><hr>
                  <div class="row">   
            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-hover table-bordered table-striped">
                      <thead>
                        <tr class="table-info">
                          <th>Full Name</th>
                          <th>Email Address</th>
                          <th>Phone Number</th>
                          <th>Added On</th>
                          <th>Verification Status</th>
                          <th>View Detail</th>
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
                
                    $query1 = "SELECT * FROM register ORDER BY date DESC";
                    $view_users1 = mysqli_query($connection, $query1);
                    $total = mysqli_num_rows($view_users1);
                    $total = ceil($total/$perpage);
                    $Previous = (int)$page - 1;
                    $Next = (int)$page + 1;          
                            
                          
                $query = "SELECT * FROM register ORDER BY date DESC LIMIT $page_1, $perpage";
                $view_customers = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_customers)){
                    $id = escape($row['id']);
                    $fullname = escape($row['fullname']);
                    $email = escape($row['email']);
                    $phone = escape($row['phone']);
                    $verify_status = escape($row['verify_status']);
                    $date = escape($row['date']);
                    echo "
                <tr>
                <td>{$fullname}</td>
                <td>{$email}</td>
                <td>{$phone}</td>
                <td>{$date}</td>
                ";
            
                          if($verify_status == '0'){
                              echo "<td><button class='btn btn-danger'>Unverified</button></td>";
                          }else{
                              echo "<td><button class='btn btn-success'>Verified</button></td>";
                          }
                          
                 echo"<td><a href='view_customer_detail?id=$id'><button type='button' class='btn btn-outline-primary btn-rounded btn-icon'>
                <i class='ti-eye'></i>
                </button></a>&nbsp;<a href='delete_customer?id=$id'><button type='button' class='btn btn-danger btn-rounded btn-icon'>
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
                      <a href="view_customers?page=<?= $Previous; ?>" aria-label="Previous">
                       <span aria-hidden="true"><button class="btn btn-md btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Previous</button></span>   
                      </a>
                  </li>
                <?php 
                for($i=1; $i<=$total; $i++){
                if($i == $page){
                echo "<li><a href='view_customers?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>";
                }else{
                echo "<li><a href='view_customers?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>"; 
                }
                }
                ?>
                   <li>
                       <a href="view_customers?page=<?= $Next; ?>" aria-label="Next">
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

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
