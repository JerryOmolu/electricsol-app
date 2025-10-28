  <?php 

session_start();
include 'includes/db.php';
include 'includes/functions.php';

if(isset($_POST['update_password'])){
	$email = escape($_POST['email']);
	$new_password = escape($_POST['new_password']);
	$confirm_password = escape($_POST['confirm_password']);
	$token = escape($_POST['password_token']);
	
//	$new_password= password_hash ($new_password, PASSWORD_BCRYPT, array('cost' => 10));
//	$confirm_password= password_hash ($new_password, PASSWORD_BCRYPT, array('cost' => 10));
	
	if(!empty($token)){
		
		if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
		 
		//check if token exists
		$check_token = "SELECT verify_token FROM register WHERE verify_token='$token' LIMIT 1";
		$check_token_run = mysqli_query($connection, $check_token);
			
		if(mysqli_num_rows($check_token_run) > 0){
			
			if($new_password == $confirm_password){
				
				
			$hashedPassword= password_hash ($new_password, PASSWORD_BCRYPT, array('cost' => 10));
				
				$update_password = "UPDATE register SET password='$hashedPassword' WHERE verify_token='$token' LIMIT 1";
				$update_password_run = mysqli_query($connection, $update_password);
				
				if($update_password_run){
					
				$new_token = md5(rand())."electricsol";
				$update_to_new_token = "UPDATE register set verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
				$update_to_new_token_run = mysqli_query($connection, $update_to_new_token);
					
					$_SESSION['status'] = "Password Reset is successful";
					header("Location: login");
					exit(0);
				}else{
					$_SESSION['status'] = "Update Password failed. Something went wrong";
					header("Location: change-password?token=$token&email=$email");
					exit(0);
				}
				
			}else{
				
				$_SESSION['status'] = "New Password and Confirm Password does not match. Kindly re-enter";
				header("Location: change-password?token=$token&email=$email");
				exit(0);
			}
			
		}else{
		$_SESSION['status'] = "Invalid Token";
		header("Location: change-password?token=$token&email=$email");
		exit(0);
		}
			
		}else{
		$_SESSION['status'] = "All fields are Mandatory";
		header("Location: change-password?token=$token&email=$email");
		exit(0);
		}
		
	}else{
		$_SESSION['status'] = "No Token Available";
		header("Location: change-password");
		exit(0);	
	}
	
}

?>
