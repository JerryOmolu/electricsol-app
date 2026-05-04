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
                  <p class="card-title">Edit Product</p>
                  <div class="row">
            <div class="col-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
<!--Edit User Code-->
<?php 
if(isset($_GET['edit_product'])){
    $the_product_id = escape($_GET['edit_product']);
    $query = "SELECT * FROM product WHERE product_id  = $the_product_id ";
        $select_products = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_products)){
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
}


if(isset($_POST['edit_product'])){
    $name = escape($_POST['name']);
    $detail = escape($_POST['detail']);
    $number = escape($_POST['number']);
    $price = escape($_POST['price']);
    $keywords = escape($_POST['keywords']);
    $category = escape($_POST['category']);
    

    $query = "UPDATE product SET product_name = '{$name}', product_details = '{$detail}', product_number = '{$number}', category = '{$category}', price = '{$price}', keywords = '{$keywords}' WHERE product_id = {$the_product_id} ";
    $update_product = mysqli_query($connection,$query);
    if(!$update_product){
   die('QUERY FAILED' . mysqli_error($connection));
   }
    echo "<div class='alert alert-success'>Product Edited Successfully:" . " " . "&nbsp;&nbsp;&nbsp;<a href='view_products.php'><button class='btn btn-primary'>View Products</button></a></div>";
}

}

?>
<!--End of Edit User Code-->
                    
                    
                    
                    
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Product Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Product Name" name="name" autocomplete="off" value="<?php echo $product_name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUserName1">Product Detail</label>
                      <textarea class="form-control" name="detail" id="summernote" cols="30" rows="10" placeholder="Enter Product Detail" required><?php echo $product_details; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUserName1">Product Number</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="number" maxlength="50" autocomplete="off" value="<?php echo $product_number; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Price</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" name="price" value="<?php echo $price; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPhone">Keywords</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" name="keywords"  value="<?php echo $keywords; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Category</label>
                      <select class="form-control" id="exampleSelectRole" name="category" required>
                          <option value='<?php echo $category; ?>'><?php echo $category; ?></option>
                          <option value="Lighting">Lighting</option>
                          <option value="Power and Wiring Accessories">Power and Wiring Accessories</option>
                          <option value="Home Appliances">Home Appliances</option>
                          <option value="Consumer Electronics">Consumer Electronics</option>
                          <option value="Electrical Tools & Instruments">Electrical Tools and Instruments</option>
                          <option value="Renewable Energy Products">Renewable Energy Products</option>
                          <option value="Batteries & Power Storage">Batteries and Power Storage</option>
                          <option value="Heating & Cooling Products">Heating and Cooling Products</option>
                          <option value="Kitchen Appliances">Kitchen Appliances</option>
                          <option value="Safety & Security">Safety and Security</option>
                          <option value="Audio-Visual Equipment">Audio-Visual Equipment</option>
                          <option value="Industrial & Commercial Electrical Products">Industrial and Commercial Electrical Products</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary col-6 mr-2" name="edit_product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Product Info</button>
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
