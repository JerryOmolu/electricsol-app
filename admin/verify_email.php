<?php
session_start();
include 'includes/db.php';

if(isset($_GET['token']))
{
	$token = $_GET['token'];
	$verify_query = "SELECT verify_token,verify_status FROM user WHERE verify_token='$token' LIMIT 1";
	$verify_query_run = mysqli_query($connection, $verify_query);
	
	if(mysqli_num_rows($verify_query_run) > 0){
		$row = mysqli_fetch_array($verify_query_run);
		
		if($row['verify_status'] == "0"){
			$clicked_token = $row['verify_token'];
			$update_query = "UPDATE user SET verify_status ='1' WHERE verify_token = '$clicked_token' LIMIT 1";
			$update_query_run = mysqli_query($connection, $update_query);
			
			if($update_query_run){
				$_SESSION['status'] = "Verification Successful!. Please Sign In";
				header("Location: index");
				exit(0);
			}else{
				$_SESSION['status'] = "Verification Failed";
				header("Location: index");
				exit(0);
			}
		}else{
			$_SESSION['status'] = "Account already Verified. Please Sign In";
				header("Location: index");
		}
		
	}else{
	$_SESSION['status'] = "This token does not exists";
	header("Location: index");
	}
}
else{
	$_SESSION['status'] = "Not Allowed";
	header("Location: index");
}
?>