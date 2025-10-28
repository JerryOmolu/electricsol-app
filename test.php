<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
            
function send_reset_link($get_fullname,$get_phone,$token,$get_email){
$mail = new PHPMailer(true);

$mail->isSMTP(); 
$mail->SMTPAuth   = true; 
$mail->Host       = 'tranverse.com.ng'; 
$mail->Username   = 'no-reply@tranverse.com.ng';                     //SMTP username
$mail->Password   = 'emesomhi247';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465; 
$mail->setFrom('no-reply@tranverse.com.ng', 'Electricsol');
$mail->addAddress($get_email); 
$mail->isHTML(true);
$mail->Subject = 'Reset Password Notification';

$email_template = "<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />    
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'>    <style type='text/css'>
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }
            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }
            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }
        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        table {
            border-collapse: collapse !important;
        }
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }
        /* ANDROID CENTER FIX */
        div[style*='margin: 16px 0;'] {
            margin: 0 !important;
        }
    </style>
</head>
<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <!-- LOGO -->
        <tr>
            <td bgcolor='white' align='center'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='white' align='center' style='padding: 0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                            <h2 style='font-size: 48px; font-weight: 400; margin: 2;'>Hello $get_fullname!</h2> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                            <center><h4>You are receiving this email because we received a password reset request for your account. Ignore if it was not requested by you</h4><br>
                            <h4 style='font-size: 20px; font-weight: 400;'>Click the button below to Reset Your Password.</h4></center>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 60px 30px;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius: 3px;' bgcolor='blue'><a href='https://electricsol.com.ng/change-password.php?token=$token&email=$get_email' style='font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid blue; display: inline-block;'>Reset Password</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#D1E9F6' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                            <h3 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Need more help? Call: 07039000386 </h3>
                            <p style='margin: 0;'><a href='#' target='_blank' style='color: blue;'>We&rsquo;re here to help you out</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>";

$mail->Body    = $email_template;
$mail->send();
}

if(isset($_POST['submit'])){
	
	$email = escape($_POST['email']);
	$token = md5(rand());
	
	$check_email = "SELECT * FROM register WHERE email ='$email' LIMIT 1";
	$check_email_run = mysqli_query($connection, $check_email);
	
	if(mysqli_num_rows($check_email_run) > 0){
		
		$row = mysqli_fetch_array($check_email_run);
		$get_fullname = escape($row['fullname']);
        $get_phone = escape($row['phone']);
		$get_email = escape($row['email']);
		
$update_token = "UPDATE register SET verify_token='$token' WHERE email='$get_email' LIMIT 1"; 
$update_token_run = mysqli_query($connection, $update_token);
		
		if($update_token_run){
			
            send_reset_link("$get_fullname","$get_phone","$token","$get_email");
			$_SESSION['status'] = "Password Reset link has been sent. Please check your email";
			header("Location: forget-password.php");
			exit(0);
			
		}else{
		$_SESSION['status'] = "Something went wrong #1";
		header("Location: forget-password.php");
		exit(0);
		}
	}else{
		$_SESSION['status'] = "Email not found";
		header("Location: forget-password.php");
		exit(0);	
	}
	
}			  

?>      