<?php include "includes/db.php" ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM device WHERE device_id = $id";
    $delete_device = mysqli_query($connection, $query);
    
    header("Location: view_device");
		exit(0);
}


?>