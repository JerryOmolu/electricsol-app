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
                  <p class="card-title">PUBLIC REQUESTS TO DISCOS</p><hr>
                  <div class="row">   
            <div class="col-lg-12 stretch-card">
              <div class="card">
            <div class="card-body">
                
 <?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        $bulk_options = $_POST['bulk_options'];
        
switch($bulk_options){
    
    case 'Handled':
    $query = "UPDATE disco SET status = '{$bulk_options}', status = 'Handled' WHERE disco_id = {$checkBoxValue}";
    $handle_disco_request = mysqli_query($connection, $query);
    break; 
    
    case 'Unhandled':
    $query = "UPDATE disco SET status = '{$bulk_options}', status = 'Unhandled' WHERE disco_id = {$checkBoxValue}";
    $unhandle_disco_request = mysqli_query($connection, $query);
    break;    
        
    case 'Delete':
    $query = "DELETE FROM disco WHERE disco_id = {$checkBoxValue}";
    $delete_disco_request = mysqli_query($connection, $query);
    break; 
    }
    }
}

?>
<form action="" method="post">
<table class="table table-hover table-bordered table-striped table-responsive">
<div class="row">
 <div id="bulkOptionContainer" class="col-md-6">
    <select class="form-control" name="bulk_options" id="">
        <option value="">--Select An Action--</option>
        <option value="Handled">Change to Handled</option>
        <option value="Unhandled">Change to Unhandled</option>
        <option value="Delete">Delete Request</option>
    </select>
</div>
<div class="col-md-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
</div>
</div>
                           
                           <br>
                            <thead class="table-info">
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Disco</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 
					$perpage = 10;
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
                
                    $query1 = "SELECT * FROM disco ORDER BY date DESC";
                    $view_review1 = mysqli_query($connection, $query1);
                    $total = mysqli_num_rows($view_review1);
                    $total = ceil($total/$perpage);
                    $Previous = (int)$page - 1;
                    $Next = (int)$page + 1; 				
                
                $query = "SELECT * FROM disco ORDER BY date DESC LIMIT $page_1, $perpage";
                $view_review = mysqli_query($connection, $query);
				$number_of_report = mysqli_num_rows($view_review);
                while($row = mysqli_fetch_assoc($view_review)){
					$disco_id = escape($row['disco_id']);
					$name = escape($row['name']);
					$location = escape($row['location']);
					$phone = escape($row['phone']);
					$disco = escape($row['disco']);
					$message = escape($row['message']);
					$date = escape($row['date']);
					$status = escape($row['status']);
          
    echo "<tr>"; ?>
        
    <td><input class="checkBoxes" type='checkbox' name='checkBoxArray[]' value='<?php echo $disco_id; ?>'></td>
    <?php
    echo "<td>{$name}</td>";
    echo "<td>{$phone}</td>";
    echo "<td>{$disco}</td>";      
    echo "<td>{$date}</td>";
    if ($status == 'Handled'){
      echo "<td style='color:green'><b>{$status}</b></td>";  
    }else{
      echo "<td style='color:red'><b>{$status}</b></td>";  
    }
//    echo "<td>{$status}</td>";       
    echo "<td><a href='view_disco_detail?id=$disco_id'><button type='button' class='btn btn-warning btn-rounded btn-icon'><i class='ti-eye'></i></button></a></td>";       
    echo "</tr>";
                }

                ?>
                                
                        </tbody>
                        </table>
</form>              
                  <td style='color:green'></td>
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
                      <a href="discos?page=<?= $Previous; ?>" aria-label="Previous">
                       <span aria-hidden="true"><button class="btn btn-md btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Previous</button></span>   
                      </a>
                  </li>
                <?php 
                for($i=1; $i<=$total; $i++){
                if($i == $page){
                echo "<li><a href='discos?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>";
                }else{
                echo "<li><a href='discos?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>"; 
                }
                }
                ?>
                   <li>
                       <a href="discos?page=<?= $Next; ?>" aria-label="Next">
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
