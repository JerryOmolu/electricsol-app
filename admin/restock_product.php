<?php include "includes/admin_header.php"; ?>
<script>
        function increment() {
            let value = parseInt(document.getElementById('quantity').value);
            document.getElementById('quantity').value = value + 1;
        }

        function decrement() {
            let value = parseInt(document.getElementById('quantity').value);
            if (value > 0) {
                document.getElementById('quantity').value = value - 1;
            }
        }
</script>
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
                  <p class="card-title">Restock Product</p>
                  <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
<!--Add Product Code-->

<!--End of Add Product Code-->
                    

                  <form class="forms-sample" action="" method="get">
                    <div class="form-group">
                    <label for="exampleInputName1">Product Number</label>
                    <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Enter Product Number" name="number"  value="<?php $product_number=$_GET['number']; if(isset($_GET['number'])){echo $product_number;} ?>" readonly>
                    </div>
                      
                    <div class="form-group">
                    <label for="exampleInputName1">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Enter Product Number" name="name"  value="<?php $product_name=$_GET['name']; if(isset($_GET['name'])){echo $product_name;} ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputCity1">Current Stock Level</label>
                      <input type="number" name = "stock" class="form-control" id="exampleInputPassword4" placeholder="Enter Quantity" value="<?php $stock_level=$_GET['stock']; if(isset($_GET['stock'])){echo $stock_level;} ?>" readonly>
                    </div>
                      
                    <div class="form-group"><label for="exampleInputCity1">Quantity to Add</label></div>
                    <div class='input-group form-group'>
                    <button class="btn btn-outline-dark form-control" type="button" onclick="decrement()">-</button>
                    <input class='input-group-text form-control' type='number' id="quantity" min="1" value="1" name="quantity" readonly>
                    <button class="btn btn-outline-dark form-control" type="button" onclick="increment()">+</button>
                    </div> 
<!--
                    <div class="form-group">
                      <label for="exampleInputCity1">Quantity to Add</label>
                      <input type="number" class="form-control" id="exampleInputPassword4" name="quantity" placeholder="Enter Quantity" required>
                    </div>
-->
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Restock Product</button>
                  </form>
                    <br><br>
<!-- Restock Code-->
<?php 
	if(isset($_GET['submit'])){
        $quantity = escape($_GET['quantity']);
        $stock = escape($_GET['stock']);
        $number = escape($_GET['number']);
       
    
        $stock = "SELECT product_name,product_number,price,stock_level FROM product  WHERE product_number = '$number' ORDER BY product_id DESC LIMIT 1";
        $stock_query = mysqli_query($connection,$stock);
        
        if(mysqli_num_rows($stock_query) > 0){
		
		$row = mysqli_fetch_array($stock_query);
		$product_name = escape($row['product_name']);
        $product_number = escape($row['product_number']);
        $stock_level = escape($row['stock_level']);
        }
        
        
        if(!empty ($quantity) && !empty ($number)){
            
            $new_stock_balance = $stock_level + $quantity;
            
           $query = "UPDATE product SET stock_level = $new_stock_balance WHERE product_number = '$number' ORDER BY product_id DESC LIMIT 1";
    $top_up_query = mysqli_query($connection, $query); 
            
    if($top_up_query){
        
        if(isset($_SESSION['fullname'])){
                    $fullname = escape($_SESSION['fullname']);
                    } 
 
    }
            
            echo "<div class='alert alert-success'><b>Stock Level for $product_name ($number) has been restocked with $quantity units successfully. The new stock balance is $new_stock_balance units.</b></div>";
        }

        
    }
                  
    ?>                    
                    
 <!-- End of Restock Code-->
                             
                    
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
