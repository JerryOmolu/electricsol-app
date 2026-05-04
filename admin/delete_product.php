<?php include "includes/db.php" ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM product WHERE product_id  = $id";
    $delete_product = mysqli_query($connection, $query);
    
    header("Location: view_products");
		exit(0);
}


?>