<?php include "includes/db.php" ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM artisan WHERE artisan_id = $id";
    $delete_user = mysqli_query($connection, $query);
    
    header("Location: view_artisans");
		exit(0);
}


?>