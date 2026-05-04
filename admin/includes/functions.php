<?php


function escape ($string){
	
global $connection;	
	
return mysqli_real_escape_string($connection, trim($string));
	
}




function is_admin($username){
    global $connection;
$query = "SELECT role FROM user WHERE username = '$username'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
if($row['role'] == 'Admin'){
    return true;
}else{
    return false;
}
    
}

 
?>