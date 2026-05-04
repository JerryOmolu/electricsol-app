<?php include "includes/admin_header.php"; ?>

<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home');
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
                  <p class="card-title">View All Products</p>
<!--Search-->
<!--
                <div class="input-group">
                      <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Search Products">
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="button">Search</button>
                      </div>
                    </div>
-->
                    
        <div class="row">   
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-hover table-bordered table-striped table-responsive">
                      <thead class="table-info">
                        <tr>
                          <th>Product Name</th>
                          <th>Product Number</th>
                          <th>Price</th>
                          <th>Picture</th>
                          <th>Stock Level</th>
                          <th>Added On</th>
                          <th>Added By</th>
                          <th>Restock</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                          
                <?php
                $perpage = 50;
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
                
                    $query1 = "SELECT * FROM product ORDER BY product_id DESC";
                    $view_products1 = mysqli_query($connection, $query1);
                    $total = mysqli_num_rows($view_products1);
                    $total = ceil($total/$perpage);
                    $Previous = (int)$page - 1;
                    $Next = (int)$page + 1;           
                          
                          
                          
                $query = "SELECT * FROM product ORDER BY product_id DESC LIMIT $page_1, $perpage";
                $view_products = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_products)){
                    $product_id = escape($row['product_id']);
                    $product_name = escape($row['product_name']);
                    $product_details = escape($row['product_details']);
                    $product_number = escape($row['product_number']);
                    $category = escape($row['category']);
                    $price = escape($row['price']);
                    $keywords = escape($row['keywords']);
                    $image_one = escape($row['image_one']);
                    $image_two = escape($row['image_two']);
                    $image_three = escape($row['image_three']);
                    $stock_level = escape($row['stock_level']);
                    $added_on = escape($row['added_on']);
                    $added_by = escape($row['added_by']);
                    echo "
                    <tr>
                <td>{$product_name}</td>
                <td>{$product_number}</td>
                <td>{$price}</td>
                <td><img width='100' src='images/products/{$image_one}' alt='image'></td>";
                    
                if($stock_level <= 5){
                 echo "<td><button class='btn btn-danger'>{$stock_level}</button> </td>";   
                }else{
                 echo "<td><button class='btn btn-success'>{$stock_level}</button></td>";   
                } 
                
                echo"<td>{$added_on}</td>
                <td>{$added_by}</td>
                <td><a href='restock_product?id=$product_id&number=$product_number&stock=$stock_level&name=$product_name'><button type='button' class='btn btn-info btn-rounded btn-icon'>
                <i class='ti-plus'></i>
                </button></a></td>
                <td><a href='edit_product?source=edit_product&edit_product={$product_id}'><button type='button' class='btn btn-warning btn-rounded btn-icon'>
                <i class='ti-pencil-alt'></i>
                </button></a> &nbsp;<a href='delete_product?id=$product_id'><button type='button' class='btn btn-danger btn-rounded btn-icon'>
                <i class='ti-trash'></i>
                </button></a></td>
              </tr>";
            
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
                      <a href="view_products?page=<?= $Previous; ?>" aria-label="Previous">
                       <span aria-hidden="true"><button class="btn btn-md btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Previous</button></span>   
                      </a>
                  </li>
                <?php 
                for($i=1; $i<=$total; $i++){
                if($i == $page){
                echo "<li><a href='view_products?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>";
                }else{
                echo "<li><a href='view_products?page={$i}'>&nbsp;&nbsp;<button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>"; 
                }
                }
                ?>
                   <li>
                       <a href="view_products?page=<?= $Next; ?>" aria-label="Next">
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
