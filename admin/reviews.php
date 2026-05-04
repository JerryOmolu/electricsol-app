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
                  <p class="card-title">ALL REVIEWS</p><hr>
                  <div class="row">   
            <div class="col-lg-12 stretch-card">
              <div class="card">
            <div class="card-body">
                
    <?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        $bulk_options = $_POST['bulk_options'];
        
switch($bulk_options){
    
    case 'Approved':
    $query = "UPDATE review SET review_status = '{$bulk_options}', review_status = 'Approved' WHERE review_id = {$checkBoxValue}";
    $approve_review = mysqli_query($connection, $query);
    break; 
    
    case 'Unapproved':
    $query = "UPDATE review SET review_status = '{$bulk_options}', review_status = 'Unapproved' WHERE review_id = {$checkBoxValue}";
    $disapprove_review = mysqli_query($connection, $query);
    break;    
        
    case 'Delete':
    $query = "DELETE FROM review WHERE review_id = {$checkBoxValue}";
    $delete_review = mysqli_query($connection, $query);
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
        <option value="Approved">Approve Review(s)</option>
        <option value="Unapproved">Unapprove Review(s)</option>
        <option value="Delete">Delete Review(s)</option>
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
                                    <th>Review Author</th>
                                    <th>Review Content</th>
                                    <th>Review Date</th>
                                    <th>Star Rating</th>
                                    <th>Review Status</th>
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
                
                    $query1 = "SELECT * FROM review ORDER BY review_date DESC";
                    $view_review1 = mysqli_query($connection, $query1);
                    $total = mysqli_num_rows($view_review1);
                    $total = ceil($total/$perpage);
                    $Previous = (int)$page - 1;
                    $Next = (int)$page + 1; 				
                
                $query = "SELECT * FROM review ORDER BY review_date DESC LIMIT $page_1, $perpage";
                $view_review = mysqli_query($connection, $query);
				$number_of_report = mysqli_num_rows($view_review);
                while($row = mysqli_fetch_assoc($view_review)){
					$review_id = escape($row['review_id']);
					$review_author = escape($row['review_author']);
					$review_content = escape($row['review_content']);
					$review_rating = escape($row['review_rating']);
					$review_date = escape($row['review_date']);
					$review_status = escape($row['review_status']);
          
    echo "<tr>"; ?>
        
    <td><input class="checkBoxes" type='checkbox' name='checkBoxArray[]' value='<?php echo $review_id; ?>'></td>
    <?php
    echo "<td>{$review_author}</td>";     
    echo "<td>{$review_content}</td>";
    echo "<td>{$review_date}</td>";
    echo "<td>{$review_date}</td>";
    echo "<td>{$review_rating}</td>";       
    echo "</tr>";
                }

                ?>
                                
                        </tbody>
                        </table>
</form>              
                  
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
                      <a href="reviews?page=<?= $Previous; ?>" aria-label="Previous">
                       <span aria-hidden="true"><button class="btn btn-md btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Previous</button></span>   
                      </a>
                  </li>
                <?php 
                for($i=1; $i<=$total; $i++){
                if($i == $page){
                echo "<li><a href='reviews?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>";
                }else{
                echo "<li><a href='reviews?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>"; 
                }
                }
                ?>
                   <li>
                       <a href="reviews?page=<?= $Next; ?>" aria-label="Next">
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
