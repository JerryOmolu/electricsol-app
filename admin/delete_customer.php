<?php include "includes/db.php" ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM register WHERE id  = $id";
    $delete_customer = mysqli_query($connection, $query);
    
    header("Location: view_customers");
		exit(0);
}


?>