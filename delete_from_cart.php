<?php include "includes/db.php" ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM cart WHERE order_id = $id";
    $delete_from_cart = mysqli_query($connection, $query);
    
    header("Location: cart");
		exit(0);
}


?>