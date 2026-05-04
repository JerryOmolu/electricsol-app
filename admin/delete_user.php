<?php include "includes/db.php" ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM user WHERE user_id = $id";
    $delete_user = mysqli_query($connection, $query);
    
    header("Location: view_users");
		exit(0);
}


?>