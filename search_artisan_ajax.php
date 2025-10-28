<?php
include 'includes/db.php';

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connection, $_POST['search']);
    $query = "SELECT name, artisan_id FROM artisan WHERE name LIKE '%$search%' OR skills LIKE '%$search%' OR state LIKE '%$search%' LIMIT 5";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $name = htmlspecialchars($row['name']);
            $id = $row['artisan_id'];
            echo "<a href='artisan-details?id=$id' class='list-group-item list-group-item-action suggestion-item'>$name</a>";
        }
    } else {
        echo "<span class='list-group-item'>No results found</span>";
    }
}
?>
